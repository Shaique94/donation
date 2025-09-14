<div class="p-6">
            <!-- Page Header -->
            <div class="mb-6">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Create New Plan</h1>
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
                <form wire:submit.prevent="create_plan" class="p-6 space-y-6">
                    <!-- Plan Name -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <label for="plan_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Plan Name <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="plan_name" 
                                wire:model="plan_name"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                placeholder="Enter plan name"
                            >
                            <!-- Livewire Error Display -->
                            <p class="mt-1 text-sm text-red-600">@error('planName') {{ $message }} @enderror </p>
                        </div>

                       
                    </div>

                    <!-- Description -->
                    <div>
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">
                            Description
                        </label>
                        <textarea 
                            id="description" 
                            rows="4" 
                            wire:model="description"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
                            placeholder="Provide a detailed description of the plan"
                        ></textarea>
                        <p class="mt-1 text-sm text-gray-500">Maximum 500 characters</p>
                    </div>

                    <!-- Pricing and Duration -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">
                                Price <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-3 top-2 text-gray-500">₹</span>
                                <input 
                                    type="number" 
                                    id="price" 
                                    wire:model="price"
                                    step="0.01"
                                    min="0"
                                    class="w-full pl-8 pr-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="0.00"
                                >
                            </div>
                            <p class="mt-1 text-sm text-red-600">@error('price') {{ $message }} @enderror </p>
                        </div>

                        <div>
                            <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">
                                Duration <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="number" 
                                id="duration" 
                                wire:model="duration"
                                min="1"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                placeholder="30"
                            >
                            <p class="mt-1 text-sm text-red-600">@error('duration') {{ $message }} @enderror</p>
                        </div>

                      
                    </div>

                   

                    <!-- Form Actions -->
                    <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                        <button 
                            type="button" 
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors"
                        >
                            Cancel
                        </button>

                        <div class="flex space-x-3">
                           

                            <button 
                                type="submit" 
                                class="px-6 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-lg shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors"
                            >
                                Create Plan
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>  