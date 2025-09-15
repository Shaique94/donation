<div class="container mx-auto p-6">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <h1 class="text-2xl font-bold text-gray-800">Bazm-e-Haidri Dashboard</h1>
        <div class="flex flex-wrap gap-2">
            <a href="{{ route('admin.donations.create') }}" 
                class="bg-green-600 text-white px-3 py-2 text-sm sm:text-base sm:px-4 rounded-lg hover:bg-green-700 whitespace-nowrap">
                + New Donation
            </a>
            <a href="{{ route('admin.expenses.create') }}" 
                class="bg-blue-600 text-white px-3 py-2 text-sm sm:text-base sm:px-4 rounded-lg hover:bg-blue-700 whitespace-nowrap">
                + New Expense
            </a>
            <button wire:click="openCreateUserModal"
                    class="bg-purple-600 text-white px-3 py-2 text-sm sm:text-base sm:px-4 rounded-lg hover:bg-purple-700 whitespace-nowrap">
                + Add User
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
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
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
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
        <div class="bg-white p-4 rounded-2xl shadow-md text-center">
            <p class="text-sm text-gray-500">Outstanding Payments</p>
            <h3 class="text-xl font-bold text-amber-600">₹{{ number_format($outstandingPayments ?? 0, 2) }}</h3>
        </div>
    </div>

    <!-- Monthly Payments Status Section -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden mb-6">
        <div class="flex justify-between items-center px-4 sm:px-6 py-3 bg-gray-50 border-b">
            <h2 class="text-lg font-semibold text-gray-700">Monthly Payment Status ({{ \Carbon\Carbon::now()->format('F Y') }})</h2>
            <a href="{{ route('admin.plan.index') }}" class="text-blue-600 hover:underline text-sm">Manage Plans</a>
        </div>
        <div class="p-2 sm:p-4 overflow-x-auto">
            @if(count($monthlyPaymentStatuses) > 0)
                <table class="min-w-full">
                    <thead>
                        <tr class="text-gray-500 text-xs sm:text-sm">
                            <th class="px-2 py-2 text-left">Member</th>
                            <th class="px-2 py-2 text-left">Plan</th>
                            <th class="px-2 py-2 text-left">Monthly Due</th>
                            <th class="px-2 py-2 text-left">This Month</th>
                            <th class="px-2 py-2 text-left">Outstanding</th>
                            <th class="px-2 py-2 text-left">Progress</th>
                            <th class="px-2 py-2 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($monthlyPaymentStatuses as $userId => $status)
                        <tr class="border-t">
                            <td class="px-2 py-3 text-xs sm:text-sm">{{ $status['user_name'] }}</td>
                            <td class="px-2 py-3 text-xs sm:text-sm">{{ $status['plan_name'] }}</td>
                            <td class="px-2 py-3 text-xs sm:text-sm">₹{{ number_format($status['monthly_payment'], 2) }}</td>
                            <td class="px-2 py-3 text-xs sm:text-sm">₹{{ number_format($status['current_month_payment'], 2) }}</td>
                            <td class="px-2 py-3 font-medium text-xs sm:text-sm text-amber-600">₹{{ number_format($status['outstanding_amount'], 2) }}</td>
                            <td class="px-2 py-3 text-xs sm:text-sm">
                                <div class="w-full bg-gray-200 rounded-full h-2.5">
                                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $status['payment_progress'] }}%"></div>
                                </div>
                                <span class="text-xs text-gray-500">{{ $status['payment_progress'] }}%</span>
                            </td>
                            <td class="px-2 py-3">
                                @if($status['status'] === 'completed')
                                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Completed</span>
                                @elseif($status['status'] === 'partial')
                                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Partial</span>
                                @else
                                    <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">Pending</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-4 text-gray-500">
                    No active plan users found
                </div>
            @endif
        </div>
    </div>

    <!-- Recent Activity Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <!-- Recent Donations -->
        <div class="bg-white rounded-2xl shadow-md overflow-hidden">
            <div class="flex justify-between items-center px-4 sm:px-6 py-3 bg-gray-50 border-b">
                <h2 class="text-lg font-semibold text-gray-700">Recent Donations</h2>
                <a href="{{ route('admin.donations') }}" class="text-blue-600 hover:underline text-sm">View All</a>
            </div>
            <div class="p-2 sm:p-4 overflow-x-auto">
                @if(isset($recentDonations) && count($recentDonations) > 0)
                    <table class="min-w-full">
                        <thead>
                            <tr class="text-gray-500 text-xs sm:text-sm">
                                <th class="px-2 py-2 text-left">Member</th>
                                <th class="px-2 py-2 text-left">Date</th>
                                <th class="px-2 py-2 text-left">Amount</th>
                                <th class="px-2 py-2 text-left">Type</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentDonations as $donation)
                            <tr class="border-t">
                                <td class="px-2 py-3 text-xs sm:text-sm">{{ $donation->name }}</td>
                                <td class="px-2 py-3 text-xs sm:text-sm">{{ \Carbon\Carbon::parse($donation->created_at)->format('d M, Y') }}</td>
                                <td class="px-2 py-3 font-medium text-xs sm:text-sm">₹{{ number_format($donation->amount, 2) }}</td>
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
            <div class="flex justify-between items-center px-4 sm:px-6 py-3 bg-gray-50 border-b">
                <h2 class="text-lg font-semibold text-gray-700">Recent Expenses</h2>
                <a href="{{ route('admin.expenses') }}" class="text-blue-600 hover:underline text-sm">View All</a>
            </div>
            <div class="p-2 sm:p-4 overflow-x-auto">
                @if(isset($recentExpenses) && count($recentExpenses) > 0)
                    <table class="min-w-full">
                        <thead>
                            <tr class="text-gray-500 text-xs sm:text-sm">
                                <th class="px-2 py-2 text-left">Purpose</th>
                                <th class="px-2 py-2 text-left">Date</th>
                                <th class="px-2 py-2 text-left">Amount</th>
                                <th class="px-2 py-2 text-left">Category</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentExpenses as $expense)
                            <tr class="border-t">
                                <td class="px-2 py-3 text-xs sm:text-sm">{{ Str::limit($expense->description, 20) }}</td>
                                <td class="px-2 py-3 text-xs sm:text-sm">{{ \Carbon\Carbon::parse($expense->date)->format('d M, Y') }}</td>
                                <td class="px-2 py-3 font-medium text-red-600 text-xs sm:text-sm">₹{{ number_format($expense->amount, 2) }}</td>
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
        <div class="flex justify-between items-center px-4 sm:px-6 py-3 bg-gray-50 border-b">
            <h2 class="text-lg font-semibold text-gray-700">Members & Plans</h2>
            <a href="{{ route('admin.users') }}" class="text-blue-600 hover:underline text-sm">Manage Members</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full table-auto">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-2 sm:px-4 py-3 text-left text-xs sm:text-sm">Name</th>
                        <th class="px-2 sm:px-4 py-3 text-left text-xs sm:text-sm hidden md:table-cell">Email</th>
                        <th class="px-2 sm:px-4 py-3 text-left text-xs sm:text-sm hidden sm:table-cell">Role</th>
                        <th class="px-2 sm:px-4 py-3 text-left text-xs sm:text-sm">Plan</th>
                        <th class="px-2 sm:px-4 py-3 text-left text-xs sm:text-sm">Status</th>
                        <th class="px-2 sm:px-4 py-3 text-left text-xs sm:text-sm">Outstanding</th>
                        <th class="px-2 sm:px-4 py-3 text-left text-xs sm:text-sm hidden lg:table-cell">Start</th>
                        <th class="px-2 sm:px-4 py-3 text-left text-xs sm:text-sm hidden lg:table-cell">End</th>
                        <th class="px-2 sm:px-4 py-3 text-left text-xs sm:text-sm">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    @php
                        $plan = $user->plans->first();
                    @endphp
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">{{ $user->name }}</td>
                        <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden md:table-cell">{{ $user->email }}</td>
                        <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden sm:table-cell">{{ ucfirst($user->role ?? 'user') }}</td>
                        <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">{{ $plan?->name ?? '—' }}</td>
                        <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">
                            @if($plan && isset($plan->pivot) && $plan->pivot->status === 'active')
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Active</span>
                            @elseif($plan && isset($plan->pivot))
                                <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">{{ ucfirst($plan->pivot->status ?? 'Expired') }}</span>
                            @else
                                <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs rounded-full">No Plan</span>
                            @endif
                        </td>
                        <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm font-medium">
                            @if($plan && isset($plan->pivot) && $plan->pivot->status === 'active')
                                <a href="{{ route('admin.plan.payments', ['planId' => $plan->id, 'userId' => $user->id]) }}" class="text-amber-600 hover:text-amber-800 underline">
                                    ₹{{ number_format($plan->pivot->amount_remaining ?? 0, 0) }}
                                </a>
                            @else
                                —
                            @endif
                        </td>
                        <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden lg:table-cell">{{ $plan && isset($plan->pivot) ? $plan->pivot->start_date : '—' }}</td>
                        <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm hidden lg:table-cell">{{ $plan && isset($plan->pivot) ? $plan->pivot->end_date : '—' }}</td>
                        <td class="px-2 sm:px-4 py-3 text-xs sm:text-sm">
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
    </div>
    
    <!-- Current Month Transactions -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden mb-6">
        <div class="flex justify-between items-center px-4 sm:px-6 py-3 bg-gray-50 border-b">
            <h2 class="text-lg font-semibold text-gray-700">Current Month Transactions ({{ \Carbon\Carbon::now()->format('F Y') }})</h2>
            <a href="{{ route('admin.donations') }}" class="text-blue-600 hover:underline text-sm">View All Transactions</a>
        </div>
        <div class="p-2 sm:p-4 overflow-x-auto">
            @if(isset($currentMonthTransactions) && count($currentMonthTransactions) > 0)
                <table class="min-w-full">
                    <thead>
                        <tr class="text-gray-500 text-xs sm:text-sm">
                            <th class="px-2 py-2 text-left">Member</th>
                            <th class="px-2 py-2 text-left">Plan</th>
                            <th class="px-2 py-2 text-left">Amount</th>
                            <th class="px-2 py-2 text-left">Method</th>
                            <th class="px-2 py-2 text-left">Date</th>
                            <th class="px-2 py-2 text-left">Receipt</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($currentMonthTransactions as $transaction)
                        <tr class="border-t">
                            <td class="px-2 py-3 text-xs sm:text-sm">{{ $transaction->user?->name ?? 'Unknown' }}</td>
                            <td class="px-2 py-3 text-xs sm:text-sm">{{ $transaction->plan?->name ?? 'No Plan' }}</td>
                            <td class="px-2 py-3 font-medium text-xs sm:text-sm">₹{{ number_format($transaction->amount, 2) }}</td>
                            <td class="px-2 py-3 text-xs sm:text-sm">
                                <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">
                                    {{ $transaction->payment_method }}
                                </span>
                            </td>
                            <td class="px-2 py-3 text-xs sm:text-sm">{{ \Carbon\Carbon::parse($transaction->donation_date)->format('d M') }}</td>
                            <td class="px-2 py-3 text-xs sm:text-sm">{{ $transaction->receipt_number ?? '—' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center py-4 text-gray-500">
                    No transactions this month
                </div>
            @endif
        </div>
    </div>

    <!-- Plan Distribution Chart -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden mb-6 p-4 sm:p-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Plan Distribution</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-{{ count($plans) }} gap-4">
            @forelse($plans as $index => $plan)
                @php
                    // Assign different colors based on the plan index
                    $colors = ['amber', 'blue', 'purple', 'green', 'indigo', 'rose'];
                    $colorIndex = $index % count($colors);
                    $colorClass = $colors[$colorIndex] . '-500';
                @endphp
                <div class="flex flex-col items-center justify-center p-4 border rounded-xl">
                    <div class="text-2xl sm:text-3xl font-bold text-{{ $colorClass }}">₹{{ number_format($plan->amount ?? 0, 0) }}</div>
                    <div class="text-sm text-gray-500 mt-2">{{ $plan->name ?? 'Unknown Plan' }}</div>
                    <div class="font-semibold mt-1">{{ $users->filter(function($user) use($plan) { 
                        return $user->plans && $user->plans->isNotEmpty() && $user->plans->first()?->id == $plan->id; 
                    })->count() }} Members</div>
                </div>
            @empty
                <div class="col-span-full text-center py-6 text-gray-500">
                    No plans available
                </div>
            @endforelse
        </div>
    </div>
</div>
