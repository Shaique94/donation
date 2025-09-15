<div class="container mx-auto p-6">
    <!-- Header with decorative elements -->
    <div class="relative mb-8 pb-4 border-b border-gray-200">
        <h1 class="text-3xl font-bold text-gray-800 flex items-center">
            <svg class="w-8 h-8 mr-3 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM14 11a1 1 0 011 1v1h1a1 1 0 110 2h-1v1a1 1 0 11-2 0v-1h-1a1 1 0 110-2h1v-1a1 1 0 011-1z"/>
            </svg>
            Bazm-e-Haidri Reports Dashboard
        </h1>
        <p class="text-gray-600 text-lg mt-2 ml-11">Comprehensive financial analytics and reporting tools</p>
        
        <!-- Date Filter -->
        <div class="absolute right-0 top-0 flex items-center space-x-3">
            <div class="relative">
                <select class="bg-white border border-gray-300 text-gray-700 py-2 pl-3 pr-8 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent">
                    <option>All Time</option>
                    <option>This Month</option>
                    <option>Last 3 Months</option>
                    <option>This Year</option>
                    <option selected>2025</option>
                    <option>2024</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"/>
                    </svg>
                </div>
            </div>
            <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition flex items-center">
                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                </svg>
                Refresh Data
            </button>
        </div>
    </div>

    <!-- Financial Highlights -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500">Total Donations</p>
            <div class="mt-2 text-2xl font-semibold text-green-600">₹{{ number_format($totalDonations ?? 0, 2) }}</div>
            <p class="text-xs text-gray-500 mt-2">Year-to-date donations</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500">Total Expenses</p>
            <div class="mt-2 text-2xl font-semibold text-red-600">₹{{ number_format($totalExpenses ?? 0, 2) }}</div>
            <p class="text-xs text-gray-500 mt-2">Year-to-date expenses</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <p class="text-sm text-gray-500">Net Balance</p>
            <div class="mt-2 text-2xl font-semibold {{ ($netBalance ?? 0) >= 0 ? 'text-green-600' : 'text-red-600' }}">₹{{ number_format($netBalance ?? 0, 2) }}</div>
            <p class="text-xs text-gray-500 mt-2">Donations minus expenses</p>
        </div>
    </div>
    <!-- Charts & Reports Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <!-- Monthly Donation Trends -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 col-span-2">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Monthly Donation Trends</h2>
                <div class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-0.5 rounded flex items-center">
                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12 7a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0V8.414l-4.293 4.293a1 1 0 01-1.414 0L8 10.414l-4.293 4.293a1 1 0 01-1.414-1.414l5-5a1 1 0 011.414 0L11 10.586 14.586 7H12z" clip-rule="evenodd"/>
                    </svg>
                    Year: {{ date('Y') }}
                </div>
            </div>
            @if($monthlyDonationTrends && $monthlyDonationTrends->count())
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead>
                            <tr class="text-gray-500 border-b">
                                <th class="py-2 px-3 font-medium">Month</th>
                                <th class="py-2 px-3 text-right font-medium">Donation Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($monthlyDonationTrends as $month => $total)
                                <tr class="border-b border-gray-50 hover:bg-gray-50">
                                    <td class="py-3 px-3 text-gray-700">{{ $month }}</td>
                                    <td class="py-3 px-3 text-right font-semibold text-green-600">₹{{ number_format($total, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    <p>No donation trend data available for this year.</p>
                </div>
            @endif
        </div>

        <!-- Expense by Category -->
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h2 class="text-lg font-semibold mb-4">Expenses by Category</h2>
            @if($expenseByCategory && $expenseByCategory->count())
                <div class="space-y-3">
                    @foreach($expenseByCategory as $category => $total)
                        <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                            <span class="text-gray-700 font-medium">{{ $category }}</span>
                            <span class="font-semibold text-red-600">₹{{ number_format($total, 2) }}</span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/>
                    </svg>
                    <p>No expense data available.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Plan Distribution & Member Stats -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 col-span-2">
            <h2 class="text-lg font-semibold mb-6">Plan Distribution</h2>
            @if($planDistribution && $planDistribution->count())
                <div class="space-y-4">
                    @foreach($planDistribution as $plan)
                        <div class="border border-gray-100 rounded-lg p-4">
                            <div class="flex justify-between items-start mb-2">
                                <div>
                                    <div class="font-semibold text-gray-800">{{ $plan->name }}</div>
                                    <div class="text-sm text-gray-500">₹{{ number_format($plan->amount ?? 0, 2) }} • {{ $plan->users_count ?? 0 }} members</div>
                                </div>
                                <div class="text-lg font-bold text-blue-600">₹{{ number_format($plan->donations_sum_amount ?? 0, 2) }}</div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                @php
                                    $percentage = $planDistribution->sum('donations_sum_amount') > 0 
                                        ? ($plan->donations_sum_amount / $planDistribution->sum('donations_sum_amount')) * 100 
                                        : 0;
                                @endphp
                                <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $percentage }}%"></div>
                            </div>
                            <div class="flex justify-between text-xs text-gray-500 mt-1">
                                <span>{{ number_format($percentage, 1) }}% of total</span>
                                <span>{{ $plan->users_count ?? 0 }} contributors</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p>No plans found.</p>
                </div>
            @endif
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h2 class="text-lg font-semibold mb-4">Member Statistics</h2>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="text-center p-3 bg-blue-50 rounded-lg">
                    <div class="text-2xl font-bold text-blue-600">{{ $totalMembers ?? 0 }}</div>
                    <div class="text-xs text-gray-500">Total Members</div>
                </div>
                <div class="text-center p-3 bg-green-50 rounded-lg">
                    <div class="text-2xl font-bold text-green-600">{{ $activePlans ?? 0 }}</div>
                    <div class="text-xs text-gray-500">Active Plans</div>
                </div>
                <div class="text-center p-3 bg-red-50 rounded-lg">
                    <div class="text-2xl font-bold text-red-600">{{ $expiredPlans ?? 0 }}</div>
                    <div class="text-xs text-gray-500">Expired Plans</div>
                </div>
                <div class="text-center p-3 bg-purple-50 rounded-lg">
                    <div class="text-2xl font-bold text-purple-600">{{ $renewalRate ?? 0 }}%</div>
                    <div class="text-xs text-gray-500">Renewal Rate</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Top Contributors and Recent Transactions -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <h2 class="text-lg font-semibold mb-4">Top Contributors</h2>
            @if($topContributors && $topContributors->count())
                <div class="space-y-3">
                    @foreach($topContributors as $index => $user)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div class="flex items-center">
                                <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                    <span class="text-sm font-medium text-green-600">#{{ $index + 1 }}</span>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-800">{{ $user->name }}</div>
                                    <div class="text-xs text-gray-500">{{ $user->email }}</div>
                                </div>
                            </div>
                            <div class="font-bold text-green-600">₹{{ number_format($user->donations_sum_amount ?? 0, 2) }}</div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"/>
                    </svg>
                    <p>No contributors yet.</p>
                </div>
            @endif
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold">Recent Transactions</h2>
                <button class="text-blue-600 hover:text-blue-800 text-sm flex items-center">
                    View All
                    <svg class="w-4 h-4 ml-1" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                    </svg>
                </button>
            </div>
            @if($recentTransactions && $recentTransactions->count())
                <div class="space-y-3">
                    @foreach($recentTransactions as $tx)
                        <div class="flex justify-between items-center p-3 border border-gray-100 rounded-lg">
                            <div class="flex-1">
                                <div class="flex justify-between items-start">
                                    <div>
                                        <div class="font-medium text-gray-800 text-sm">{{ $tx->description ?? ($tx->notes ?? 'Transaction') }}</div>
                                        <div class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($tx->transaction_date)->format('d M, Y') }}</div>
                                    </div>
                                    <div class="text-right">
                                        @if(isset($tx->amount))
                                            <div class="font-semibold {{ $tx->type === 'donation' ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $tx->type === 'donation' ? '+' : '-' }}₹{{ number_format($tx->amount, 2) }}
                                            </div>
                                        @else
                                            <div class="text-gray-400">—</div>
                                        @endif
                                        <div class="text-xs">
                                            <span class="px-2 py-1 rounded-full text-xs {{ $tx->type === 'donation' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ ucfirst($tx->type) }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                    </svg>
                    <p>No recent transactions.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
        <h2 class="text-lg font-semibold mb-4">Quick Report Actions</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <button class="flex items-center justify-center p-4 border border-blue-200 rounded-lg hover:bg-blue-50 transition">
                <svg class="w-5 h-5 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M6 2a2 2 0 00-2 2v12a2 2 0 002 2h8a2 2 0 002-2V7.414A2 2 0 0015.414 6L12 2.586A2 2 0 0010.586 2H6zm5 6a1 1 0 10-2 0v3.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L11 11.586V8z" clip-rule="evenodd"/>
                </svg>
                <span class="text-blue-600 font-medium">Export Financial Report</span>
            </button>
            <button class="flex items-center justify-center p-4 border border-green-200 rounded-lg hover:bg-green-50 transition">
                <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd"/>
                </svg>
                <span class="text-green-600 font-medium">Download Member List</span>
            </button>
            <button class="flex items-center justify-center p-4 border border-purple-200 rounded-lg hover:bg-purple-50 transition">
                <svg class="w-5 h-5 mr-2 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd"/>
                </svg>
                <span class="text-purple-600 font-medium">Generate Annual Report</span>
            </button>
        </div>
    </div>
</div>