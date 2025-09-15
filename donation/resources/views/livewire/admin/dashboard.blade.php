<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Bazm-e-Haidri Dashboard</h1>
        <div class="space-x-2">
            <a href="{{ route('admin.donations.create') }}" 
                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                + New Donation
            </a>
            <a href="{{ route('admin.expenses.create') }}" 
                class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                + New Expense
            </a>
            <button wire:click="openCreateUserModal"
                    class="bg-purple-600 text-white px-4 py-2 rounded-lg hover:bg-purple-700">
                + Add User
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-4 gap-4 mb-6">
        <div class="bg-white p-4 rounded-2xl shadow-md text-center">
            <p class="text-sm text-gray-500">Total Users</p>
            <h3 class="text-xl font-bold">{{ $totalUsers }}</h3>
        </div>
        <div class="bg-white p-4 rounded-2xl shadow-md text-center">
            <p class="text-sm text-gray-500">Active Plans</p>
            <h3 class="text-xl font-bold text-green-600">{{ $activePlans }}</h3>
        </div>
        <div class="bg-white p-4 rounded-2xl shadow-md text-center">
            <p class="text-sm text-gray-500">Expired Plans</p>
            <h3 class="text-xl font-bold text-red-600">{{ $expiredPlans }}</h3>
        </div>
        <div class="bg-white p-4 rounded-2xl shadow-md text-center">
            <p class="text-sm text-gray-500">Plan Revenue</p>
            <h3 class="text-xl font-bold">₹{{ number_format($revenue, 2) }}</h3>
        </div>
    </div>
    
    <!-- Donation & Expense Stats -->
    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white p-4 rounded-2xl shadow-md text-center">
            <p class="text-sm text-gray-500">Total Donations</p>
            <h3 class="text-xl font-bold text-green-600">₹{{ number_format($totalDonations ?? 0, 2) }}</h3>
        </div>
        <div class="bg-white p-4 rounded-2xl shadow-md text-center">
            <p class="text-sm text-gray-500">Total Expenses</p>
            <h3 class="text-xl font-bold text-red-600">₹{{ number_format($totalExpenses ?? 0, 2) }}</h3>
        </div>
        <div class="bg-white p-4 rounded-2xl shadow-md text-center">
            <p class="text-sm text-gray-500">Net Balance</p>
            <h3 class="text-xl font-bold {{ ($netBalance ?? 0) >= 0 ? 'text-green-600' : 'text-red-600' }}">
                ₹{{ number_format($netBalance ?? 0, 2) }}
            </h3>
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="grid grid-cols-2 gap-6 mb-6">
        <!-- Recent Donations -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="flex justify-between items-center px-6 py-3 bg-gray-50 border-b">
                <h2 class="text-lg font-semibold text-gray-700">Recent Donations</h2>
                <a href="{{ route('admin.donations') }}" class="text-blue-600 hover:underline text-sm">View All</a>
            </div>
            <div class="p-4">
                @if(isset($recentDonations) && count($recentDonations) > 0)
                    <table class="min-w-full">
                        <thead>
                            <tr class="text-gray-500 text-sm">
                                <th class="px-2 py-2 text-left">Member</th>
                                <th class="px-2 py-2 text-left">Date</th>
                                <th class="px-2 py-2 text-left">Amount</th>
                                <th class="px-2 py-2 text-left">Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentDonations as $donation)
                            <tr class="border-t">
                                <td class="px-2 py-3">{{ $donation->name }}</td>
                                <td class="px-2 py-3">{{ \Carbon\Carbon::parse($donation->created_at)->format('d M, Y') }}</td>
                                <td class="px-2 py-3 font-medium">₹{{ number_format($donation->amount, 2) }}</td>
                                <td class="px-2 py-3">
                                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">
                                        {{ $donation->payment_method }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center py-4 text-gray-500">
                        No recent donations
                    </div>
                @endif
            </div>
        </div>

        <!-- Recent Expenses -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="flex justify-between items-center px-6 py-3 bg-gray-50 border-b">
                <h2 class="text-lg font-semibold text-gray-700">Recent Expenses</h2>
                <a href="{{ route('admin.expenses') }}" class="text-blue-600 hover:underline text-sm">View All</a>
            </div>
            <div class="p-4">
                @if(isset($recentExpenses) && count($recentExpenses) > 0)
                    <table class="min-w-full">
                        <thead>
                            <tr class="text-gray-500 text-sm">
                                <th class="px-2 py-2 text-left">Purpose</th>
                                <th class="px-2 py-2 text-left">Date</th>
                                <th class="px-2 py-2 text-left">Amount</th>
                                <th class="px-2 py-2 text-left">Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentExpenses as $expense)
                            <tr class="border-t">
                                <td class="px-2 py-3">{{ Str::limit($expense->description, 30) }}</td>
                                <td class="px-2 py-3">{{ \Carbon\Carbon::parse($expense->date)->format('d M, Y') }}</td>
                                <td class="px-2 py-3 font-medium text-red-600">₹{{ number_format($expense->amount, 2) }}</td>
                                <td class="px-2 py-3">
                                    <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">
                                        {{ $expense->category }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="text-center py-4 text-gray-500">
                        No recent expenses
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden mb-6">
        <div class="flex justify-between items-center px-6 py-3 bg-gray-50 border-b">
            <h2 class="text-lg font-semibold text-gray-700">Members & Plans</h2>
            <a href="{{ route('admin.users') }}" class="text-blue-600 hover:underline text-sm">Manage Members</a>
        </div>
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left">Name</th>
                    <th class="px-4 py-3 text-left">Email</th>
                    <th class="px-4 py-3 text-left">Role</th>
                    <th class="px-4 py-3 text-left">Plan</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-left">Start</th>
                    <th class="px-4 py-3 text-left">End</th>
                    <th class="px-4 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                @php
                    $plan = $user->plans->first();
                @endphp
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3">{{ $user->name }}</td>
                    <td class="px-4 py-3">{{ $user->email }}</td>
                    <td class="px-4 py-3">{{ ucfirst($user->role) }}</td>
                    <td class="px-4 py-3">{{ $plan?->name ?? '—' }}</td>
                    <td class="px-4 py-3">
                        @if($plan?->pivot->status === 'active')
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Active</span>
                        @elseif($plan)
                            <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">Expired</span>
                        @else
                            <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">No Plan</span>
                        @endif
                    </td>
                    <td class="px-4 py-3">{{ $plan?->pivot->start_date ?? '—' }}</td>
                    <td class="px-4 py-3">{{ $plan?->pivot->end_date ?? '—' }}</td>
                    <td class="px-4 py-3">
                        <button wire:click="editUser({{ $user->id }})" class="text-blue-600 hover:text-blue-800">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    <!-- Plan Distribution Chart -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden mb-6 p-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Plan Distribution</h2>
        <div class="grid grid-cols-3 gap-4">
            <div class="flex flex-col items-center justify-center p-4 border rounded-xl">
                <div class="text-3xl font-bold text-amber-500">₹3,000</div>
                <div class="text-sm text-gray-500 mt-2">Basic Plan</div>
                <div class="font-semibold mt-1">{{ $users->filter(function($user) { 
                    return $user->plans->first()?->amount == 3000; 
                })->count() }} Members</div>
            </div>
            <div class="flex flex-col items-center justify-center p-4 border rounded-xl">
                <div class="text-3xl font-bold text-blue-500">₹4,000</div>
                <div class="text-sm text-gray-500 mt-2">Standard Plan</div>
                <div class="font-semibold mt-1">{{ $users->filter(function($user) { 
                    return $user->plans->first()?->amount == 4000; 
                })->count() }} Members</div>
            </div>
            <div class="flex flex-col items-center justify-center p-4 border rounded-xl">
                <div class="text-3xl font-bold text-purple-500">₹5,000</div>
                <div class="text-sm text-gray-500 mt-2">Premium Plan</div>
                <div class="font-semibold mt-1">{{ $users->filter(function($user) { 
                    return $user->plans->first()?->amount == 5000; 
                })->count() }} Members</div>
            </div>
        </div>
    </div>
</div>
