<div class="container mx-auto p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Donation Management</h1>
        <button wire:click="createDonation"
                class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            + Record Donation
        </button>
    </div>

    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
            <p>{{ session('message') }}</p>
        </div>
    @endif

    <!-- Donation Summary -->
    <div class="bg-white rounded-2xl shadow-md p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Donation Summary</h2>
        <div class="grid grid-cols-3 gap-6">
            <div>
                <h3 class="text-gray-500 text-sm mb-1">Total Donations</h3>
                <p class="text-2xl font-bold text-green-600">₹{{ number_format($totalDonations, 2) }}</p>
            </div>
            <div>
                <!-- Monthly Trend -->
                <h3 class="text-gray-500 text-sm mb-2">This Year's Monthly Donations</h3>
                <div class="space-y-2">
                    @php
                        $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                    @endphp
                    
                    @foreach($donationsByMonth as $donation)
                    <div class="flex justify-between items-center">
                        <span class="text-sm">{{ $months[$donation->month - 1] }}</span>
                        <span class="text-sm font-medium">₹{{ number_format($donation->total, 2) }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
            <div>
                <!-- Plan Distribution -->
                <h3 class="text-gray-500 text-sm mb-2">Donations by Plan</h3>
                <div class="space-y-2">
                    @foreach($donationsByPlan as $donation)
                    <div class="flex justify-between items-center">
                        <span class="text-sm">{{ $donation->name ?? 'No Plan' }}</span>
                        <span class="text-sm font-medium">₹{{ number_format($donation->total, 2) }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="bg-white rounded-2xl shadow-md p-4 mb-6">
        <div class="flex flex-wrap items-center gap-4">
            <div class="flex-grow">
                <input type="text" wire:model.live.debounce.300ms="searchTerm" 
                       class="border rounded-lg px-4 py-2 w-full" 
                       placeholder="Search by name, email or receipt...">
            </div>
            <div>
                <select wire:model.live="filterPlan" 
                        class="border rounded-lg px-4 py-2">
                    <option value="">All Plans</option>
                    @foreach($plans as $plan)
                        <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <select wire:model.live="filterStatus" 
                        class="border rounded-lg px-4 py-2">
                    <option value="">All Statuses</option>
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                    <option value="failed">Failed</option>
                </select>
            </div>
            <div>
                <select wire:model.live="dateRange" 
                        class="border rounded-lg px-4 py-2">
                    <option value="">All Time</option>
                    <option value="today">Today</option>
                    <option value="week">This Week</option>
                    <option value="month">This Month</option>
                    <option value="year">This Year</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Donations Table -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left">Member</th>
                    <th class="px-4 py-3 text-left">Amount</th>
                    <th class="px-4 py-3 text-left">Date</th>
                    <th class="px-4 py-3 text-left">Payment Method</th>
                    <th class="px-4 py-3 text-left">Plan</th>
                    <th class="px-4 py-3 text-left">Status</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($donations as $donation)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3">
                        {{ $donation->user->name }}
                        <div class="text-xs text-gray-500">{{ $donation->user->email }}</div>
                    </td>
                    <td class="px-4 py-3 font-medium text-green-600">₹{{ number_format($donation->amount, 2) }}</td>
                    <td class="px-4 py-3">{{ \Carbon\Carbon::parse($donation->donation_date)->format('d M, Y') }}</td>
                    <td class="px-4 py-3">{{ $donation->payment_method }}</td>
                    <td class="px-4 py-3">{{ $donation->plan->name ?? '—' }}</td>
                    <td class="px-4 py-3">
                        @if($donation->status === 'completed')
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Completed</span>
                        @elseif($donation->status === 'pending')
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Pending</span>
                        @else
                            <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">Failed</span>
                        @endif
                    </td>
                    <td class="px-4 py-3 text-center">
                        <button wire:click="editDonation({{ $donation->id }})" class="text-blue-600 hover:text-blue-800 mr-2">
                            <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </button>
                        <button wire:click="generateReceipt({{ $donation->id }})" class="text-green-600 hover:text-green-800 mr-2">
                            <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </button>
                        <button wire:click="deleteDonation({{ $donation->id }})" 
                                class="text-red-600 hover:text-red-800"
                                onclick="return confirm('Are you sure you want to delete this donation record?')">
                            <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-4">
            {{ $donations->links() }}
        </div>
    </div>

    <!-- Donation Modal -->
    @if($showModal)
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="fixed inset-0 bg-black opacity-50"></div>
        <div class="bg-white p-6 rounded-lg shadow-lg z-10 w-full max-w-md">
            <h2 class="text-lg font-bold mb-4">{{ $donationId ? 'Edit' : 'Record' }} Donation</h2>
            
            <form wire:submit.prevent="saveDonation">
                <div class="mb-4">
                    <label for="user_id" class="block text-sm font-medium text-gray-700 mb-1">Member</label>
                    <select wire:model="user_id" id="user_id" 
                            class="w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">Select Member</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                        @endforeach
                    </select>
                    @error('user_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                
                <div class="mb-4">
                    <label for="amount" class="block text-sm font-medium text-gray-700 mb-1">Amount (₹)</label>
                    <input type="number" step="0.01" wire:model="amount" id="amount" 
                           class="w-full border-gray-300 rounded-md shadow-sm">
                    @error('amount') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                
                <div class="mb-4">
                    <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-1">Payment Method</label>
                    <select wire:model="payment_method" id="payment_method" 
                            class="w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">Select Payment Method</option>
                        <option value="Cash">Cash</option>
                        <option value="UPI">UPI</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                        <option value="Cheque">Cheque</option>
                        <option value="Online">Online</option>
                    </select>
                    @error('payment_method') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                
                <div class="mb-4">
                    <label for="receipt_number" class="block text-sm font-medium text-gray-700 mb-1">Receipt Number</label>
                    <input type="text" wire:model="receipt_number" id="receipt_number" 
                           class="w-full border-gray-300 rounded-md shadow-sm">
                </div>
                
                <div class="mb-4">
                    <label for="donation_date" class="block text-sm font-medium text-gray-700 mb-1">Donation Date</label>
                    <input type="date" wire:model="donation_date" id="donation_date" 
                           class="w-full border-gray-300 rounded-md shadow-sm">
                    @error('donation_date') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                
                <div class="mb-4">
                    <label for="plan_id" class="block text-sm font-medium text-gray-700 mb-1">Plan (Optional)</label>
                    <select wire:model="plan_id" id="plan_id" 
                            class="w-full border-gray-300 rounded-md shadow-sm">
                        <option value="">No Plan</option>
                        @foreach($plans as $plan)
                            <option value="{{ $plan->id }}">{{ $plan->name }} (₹{{ number_format($plan->amount, 2) }})</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="mb-4">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select wire:model="status" id="status" 
                            class="w-full border-gray-300 rounded-md shadow-sm">
                        <option value="completed">Completed</option>
                        <option value="pending">Pending</option>
                        <option value="failed">Failed</option>
                    </select>
                    @error('status') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                </div>
                
                <div class="mb-4">
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                    <textarea wire:model="notes" id="notes" rows="3"
                              class="w-full border-gray-300 rounded-md shadow-sm"></textarea>
                </div>
                
                <div class="flex justify-end space-x-3 mt-6">
                    <button type="button" wire:click="closeModal" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                        {{ $donationId ? 'Update' : 'Save' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endif
</div>