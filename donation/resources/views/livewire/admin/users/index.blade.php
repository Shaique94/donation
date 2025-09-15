<div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">
    <!-- Header with Search and Add User Button -->
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Members</h1>
            <p class="text-gray-600 text-sm mt-1">Manage members, their plans and donations</p>
        </div>
        <div class="flex space-x-2">
            <a href="{{ route('admin.plan.index') }}"
               class="bg-blue-100 hover:bg-blue-200 text-blue-700 px-4 py-2 text-sm rounded-lg">
               View Plans
            </a>
            <a href="{{ route('admin.users.add') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 text-sm rounded-lg shadow">
               + Add New Member
            </a>
        </div>
    </div>

    <!-- User Cards (for mobile) -->
    <div class="grid grid-cols-1 gap-4 mb-6 sm:hidden">
        @forelse($users as $user)
            <div class="bg-white rounded-lg shadow p-4">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="font-semibold text-lg">{{ $user->name }}</h3>
                    <span class="px-2 py-1 rounded-full text-xs {{ $user->role === 'admin' ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                        {{ ucfirst($user->role ?? 'Member') }}
                    </span>
                </div>
                <p class="text-gray-600 text-sm mb-3">{{ $user->email }}</p>
                
                @php
                    $activePlan = $user->plans->where('pivot.status', 'active')->first();
                @endphp

                @if($activePlan)
                    <div class="border-t pt-3 mb-3">
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-500">Plan:</span>
                            <span class="font-medium">{{ $activePlan->name }}</span>
                        </div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-500">Outstanding:</span>
                            <span class="text-amber-600 font-medium">₹{{ number_format($activePlan->pivot->amount_remaining ?? 0, 2) }}</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2 mb-1">
                            @php
                                $paymentProgress = $activePlan->pivot->total_required > 0 
                                    ? min(100, round(($activePlan->pivot->amount_paid / $activePlan->pivot->total_required) * 100))
                                    : 0;
                            @endphp
                            <div class="bg-blue-600 h-2 rounded-full" style="width: {{ $paymentProgress }}%"></div>
                        </div>
                        <div class="flex justify-between text-xs text-gray-500">
                            <span>Payment Progress</span>
                            <span>{{ $paymentProgress }}%</span>
                        </div>
                    </div>
                @else
                    <div class="border-t pt-3 mb-3 text-center text-gray-500 text-sm">
                        No active plan
                    </div>
                @endif
                
                <div class="flex justify-between mt-3">
                    <div>
                        <a href="#" class="text-blue-600 text-sm mr-3">View Details</a>
                        <a href="{{ route('admin.edit.user', $user->id) }}" class="text-blue-600 text-sm">Edit</a>
                    </div>
                    <a href="{{ route('admin.donations.create') }}?user_id={{ $user->id }}" class="text-green-600 text-sm">
                        + Add Donation
                    </a>
                </div>
            </div>
        @empty
            <div class="bg-white rounded-lg shadow p-6 text-center text-gray-500">
                No members found. Add your first member!
            </div>
        @endforelse
    </div>

    <!-- User Table (for larger screens) -->
    <div class="hidden sm:block bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-700 text-sm">
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3 hidden md:table-cell">Email</th>
                    <th class="px-4 py-3">Current Plan</th>
                    <th class="px-4 py-3">Payment Progress</th>
                    <th class="px-4 py-3">Outstanding</th>
                    <th class="px-4 py-3">Recent Donation</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm divide-y divide-gray-200">
                @forelse($users as $user)
                    @php
                        $activePlan = $user->plans->where('pivot.status', 'active')->first();
                        $recentDonation = $user->donations->first();
                        $paymentProgress = 0;
                        if($activePlan && isset($activePlan->pivot) && $activePlan->pivot->total_required > 0) {
                            $paymentProgress = min(100, round(($activePlan->pivot->amount_paid / $activePlan->pivot->total_required) * 100));
                        }
                    @endphp
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium">
                            <div class="flex items-center">
                                <div class="mr-3 h-8 w-8 bg-gray-100 rounded-full flex items-center justify-center">
                                    <span class="text-xs font-medium text-gray-500">{{ strtoupper(substr($user->name, 0, 2)) }}</span>
                                </div>
                                <div>
                                    {{ $user->name }}
                                    <div class="text-xs text-gray-500">{{ ucfirst($user->role ?? 'Member') }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 hidden md:table-cell">{{ $user->email }}</td>
                        <td class="px-4 py-3">
                            @if($activePlan)
                                <div>
                                    <span class="font-medium">{{ $activePlan->name }}</span>
                                    <div class="text-xs text-gray-500">
                                        {{ $activePlan->pivot->start_date ? \Carbon\Carbon::parse($activePlan->pivot->start_date)->format('M d, Y') : '' }}
                                        @if($activePlan->pivot->end_date)
                                            to {{ \Carbon\Carbon::parse($activePlan->pivot->end_date)->format('M d, Y') }}
                                        @endif
                                    </div>
                                </div>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($activePlan && isset($activePlan->pivot))
                                <div class="w-full bg-gray-200 rounded-full h-2.5 w-32">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $paymentProgress }}%"></div>
                                </div>
                                <div class="text-xs text-gray-500 mt-1">{{ $paymentProgress }}% Complete</div>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 font-medium">
                            @if($activePlan && isset($activePlan->pivot))
                                <div class="text-amber-600">
                                    ₹{{ number_format($activePlan->pivot->amount_remaining ?? 0, 2) }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    of ₹{{ number_format($activePlan->pivot->total_required ?? 0, 2) }}
                                </div>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @if($recentDonation)
                                <div class="text-green-600 font-medium">
                                    ₹{{ number_format($recentDonation->amount, 2) }}
                                </div>
                                <div class="text-xs text-gray-500">
                                    {{ $recentDonation->donation_date ? \Carbon\Carbon::parse($recentDonation->donation_date)->format('M d, Y') : '' }}
                                </div>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right whitespace-nowrap">
                            <div class="flex justify-end space-x-3">
                                @if($activePlan && isset($activePlan->pivot))
                                    <a href="{{ route('admin.plan.payments', ['planId' => $activePlan->id, 'userId' => $user->id]) }}" 
                                       class="text-blue-600 hover:text-blue-800" title="View Plan Payments">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                            <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                @endif
                                <a href="{{ route('admin.donations.create') }}?user_id={{ $user->id }}" 
                                   class="text-green-600 hover:text-green-800" title="Add Donation">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                    </svg>
                                </a>
                                <a href="{{ route('admin.edit.user', $user->id) }}"
                                   class="text-blue-600 hover:text-blue-800" title="Edit User">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                    </svg>
                                </a>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                            No members found. Add your first member!
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if(count($users) > 0)
        <!-- Donation Summary Card -->
        <div class="mt-6 bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Donation Summary</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                @php
                    $totalDonations = $users->flatMap(function($user) { return $user->donations; })->sum('amount');
                    $totalOutstanding = $users->reduce(function($carry, $user) {
                        $activePlan = $user->plans->where('pivot.status', 'active')->first();
                        return $carry + ($activePlan && isset($activePlan->pivot) ? ($activePlan->pivot->amount_remaining ?? 0) : 0);
                    }, 0);
                    $totalRequired = $users->reduce(function($carry, $user) {
                        $activePlan = $user->plans->where('pivot.status', 'active')->first();
                        return $carry + ($activePlan && isset($activePlan->pivot) ? ($activePlan->pivot->total_required ?? 0) : 0);
                    }, 0);
                    $overallProgress = $totalRequired > 0 ? min(100, round((($totalRequired - $totalOutstanding) / $totalRequired) * 100)) : 0;
                @endphp
                
                <div class="bg-blue-50 p-4 rounded-lg">
                    <div class="text-sm text-gray-500">Total Members</div>
                    <div class="text-2xl font-bold text-blue-600">{{ count($users) }}</div>
                </div>
                
                <div class="bg-green-50 p-4 rounded-lg">
                    <div class="text-sm text-gray-500">Total Donations</div>
                    <div class="text-2xl font-bold text-green-600">₹{{ number_format($totalDonations, 2) }}</div>
                </div>
                
                <div class="bg-amber-50 p-4 rounded-lg">
                    <div class="text-sm text-gray-500">Outstanding Amount</div>
                    <div class="text-2xl font-bold text-amber-600">₹{{ number_format($totalOutstanding, 2) }}</div>
                </div>
                
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="text-sm text-gray-500">Overall Progress</div>
                    <div class="flex items-end justify-between">
                        <div class="text-2xl font-bold text-gray-700">{{ $overallProgress }}%</div>
                        <div class="w-24 h-6 bg-gray-200 rounded-full">
                            <div class="bg-blue-600 h-6 rounded-full" style="width: {{ $overallProgress }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>