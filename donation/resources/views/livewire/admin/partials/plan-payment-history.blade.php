<div class="bg-white p-6 rounded-2xl shadow-md overflow-hidden">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold text-gray-800">Plan Payment History</h2>
        <div class="text-sm bg-blue-50 text-blue-700 px-3 py-1 rounded-full">
            {{ $planUser->status }}
        </div>
    </div>
    
    <!-- Plan Information Card -->
    <div class="mb-6 p-4 border border-gray-100 rounded-lg bg-gray-50">
        <div class="flex flex-col sm:flex-row justify-between mb-4">
            <div>
                <h3 class="font-semibold text-lg text-gray-800">{{ $plan->name }}</h3>
                <p class="text-sm text-gray-500">{{ $plan->description }}</p>
            </div>
            <div class="text-right mt-2 sm:mt-0">
                <div class="text-xl font-bold text-blue-600">₹{{ number_format($plan->amount, 2) }}</div>
                <div class="text-xs text-gray-500">Base amount</div>
            </div>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="p-3 border rounded-lg bg-white">
                <div class="text-sm text-gray-500">Total Required</div>
                <div class="text-lg font-semibold text-gray-800">₹{{ number_format($planUser->total_required, 2) }}</div>
            </div>
            <div class="p-3 border rounded-lg bg-white">
                <div class="text-sm text-gray-500">Amount Paid</div>
                <div class="text-lg font-semibold text-green-600">₹{{ number_format($planUser->amount_paid, 2) }}</div>
            </div>
            <div class="p-3 border rounded-lg bg-white">
                <div class="text-sm text-gray-500">Outstanding</div>
                <div class="text-lg font-semibold text-amber-600">₹{{ number_format($planUser->amount_remaining, 2) }}</div>
            </div>
            <div class="p-3 border rounded-lg bg-white">
                <div class="text-sm text-gray-500">Monthly Payment</div>
                <div class="text-lg font-semibold text-gray-800">₹{{ number_format($monthlyPayment, 2) }}</div>
            </div>
        </div>
    </div>
    
    <!-- Payment Progress -->
    <div class="mb-6">
        <div class="flex justify-between mb-2">
            <h3 class="font-semibold text-gray-700">Payment Progress</h3>
            <div class="text-sm font-medium {{ $paymentProgress >= 100 ? 'text-green-600' : 'text-amber-600' }}">
                {{ $paymentProgress }}% complete
            </div>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2.5">
            <div class="bg-blue-600 h-2.5 rounded-full" style="width: {{ $paymentProgress }}%"></div>
        </div>
        
        <div class="mt-2 text-xs text-gray-500">
            <div class="flex justify-between">
                <span>Start: {{ $planUser->start_date->format('d M Y') }}</span>
                <span>End: {{ $planUser->end_date ? $planUser->end_date->format('d M Y') : 'Ongoing' }}</span>
            </div>
        </div>
    </div>
    
    <!-- Payment History Table -->
    <div class="mb-4">
        <h3 class="font-semibold text-gray-700 mb-3">Payment History</h3>
        @if(count($donations) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr class="text-left text-xs text-gray-500">
                            <th class="px-3 py-2">Date</th>
                            <th class="px-3 py-2">Amount</th>
                            <th class="px-3 py-2">Method</th>
                            <th class="px-3 py-2">Receipt</th>
                            <th class="px-3 py-2">Notes</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($donations as $donation)
                            <tr class="hover:bg-gray-50">
                                <td class="px-3 py-3 text-sm">{{ $donation->donation_date->format('d M Y') }}</td>
                                <td class="px-3 py-3 text-sm font-medium text-green-600">₹{{ number_format($donation->amount, 2) }}</td>
                                <td class="px-3 py-3 text-sm">
                                    <span class="px-2 py-1 bg-green-50 text-green-700 text-xs rounded-full">
                                        {{ $donation->payment_method }}
                                    </span>
                                </td>
                                <td class="px-3 py-3 text-sm">{{ $donation->receipt_number ?? '—' }}</td>
                                <td class="px-3 py-3 text-sm text-gray-500">{{ $donation->notes ?? '—' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="py-8 text-center text-gray-500">
                <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <p>No payment records found for this plan</p>
            </div>
        @endif
    </div>
    
    <!-- Add New Payment -->
    <div class="mt-6 border-t pt-4">
        <h3 class="font-semibold text-gray-700 mb-3">Add New Payment</h3>
        <form wire:submit.prevent="addPayment">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Amount</label>
                    <input type="number" wire:model="paymentAmount" step="0.01" min="1" 
                           class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200"
                           placeholder="Enter amount">
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Payment Method</label>
                    <select wire:model="paymentMethod" 
                           class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                        <option value="">Select method</option>
                        <option value="Cash">Cash</option>
                        <option value="UPI">UPI</option>
                        <option value="Bank Transfer">Bank Transfer</option>
                        <option value="Check">Check</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm text-gray-700 mb-1">Date</label>
                    <input type="date" wire:model="paymentDate"
                           class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200">
                </div>
                <div class="md:col-span-3">
                    <label class="block text-sm text-gray-700 mb-1">Notes (optional)</label>
                    <input type="text" wire:model="paymentNotes"
                           class="w-full rounded-lg border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200"
                           placeholder="Add any notes or comments">
                </div>
            </div>
            <div class="mt-4 flex justify-end">
                <button type="submit" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                    Record Payment
                </button>
            </div>
        </form>
    </div>
</div>