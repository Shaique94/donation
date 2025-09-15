<div class="container mx-auto px-4 py-6">
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Plan Payments</h1>
                <p class="text-gray-600">
                    {{ $user->name }} • {{ $plan->name }}
                </p>
            </div>
            <div class="flex space-x-2">
                <a href="{{ route('admin.users') }}" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50">
                    Back to Users
                </a>
                <a href="{{ route('admin.donations.create') }}?user_id={{ $user->id }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                    New Donation
                </a>
            </div>
        </div>
    </div>
    
    @if (session()->has('message'))
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
            <p>{{ session('message') }}</p>
        </div>
    @endif
    
    <!-- Include the payment history partial -->
    @include('livewire.admin.partials.plan-payment-history')
</div>