<div class="p-6">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Update Plan</h1>
                <p class="text-gray-600">Fill in the details below to create a new plan for your organization.</p>
            </div>

            <!-- Form Container -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <!-- Form Header -->
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">Plan Information</h2>
                    <p class="text-sm text-gray-600 mt-1">Provide the basic information about your plan</p>
                </div>

                <!-- Livewire Form -->
                <form wire:submit.prevent="savePlan" class="p-6 space-y-6">

                <!-- Plan Name -->
                <div>
                    <label for="plan_name" class="block text-sm font-medium text-gray-700 mb-2">
                        Plan Name <span class="text-red-500">*</span>
                    </label>
                    <input type="text" id="plan_name" wire:model="plan_name"
                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                    @error('plan_name') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                </div>

                <!-- Description -->
                <div>
                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>
                    <textarea id="description" rows="4" wire:model="description"
                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500"></textarea>
                    <p class="text-sm text-gray-500">Maximum 500 characters</p>
                </div>

                <!-- Price & Duration -->
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Price</label>
                        <input type="number" wire:model="price" step="0.01" min="0"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                        @error('price') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Duration (months)</label>
                        <input type="number" wire:model="duration" min="1"
                            class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                        @error('duration') <p class="text-red-600 text-sm">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Status -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                    <select wire:model="status"
                        class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                        <option value="active">Active</option>
                        <option value="draft">Draft</option>
                    </select>
                </div>

                <!-- Buttons -->
                <div class="flex justify-between border-t pt-6">
                    <a href="{{ route('admin.plan.index') }}"
                        class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 text-gray-700">
                        Cancel
                    </a>

                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                       Update Plan
                    </button>
                </div>
            </form>

            </div>
        </div>
    </div>
</div> 