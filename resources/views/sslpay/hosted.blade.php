<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Hosted Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="cart">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 dark:text-white mb-2">Hosted Payment - SSLCommerz</h2>
                    <p class="text-gray-600 dark:text-gray-300">Complete your purchase securely with SSLCommerz payment
                        gateway</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Cart Summary -->
                    <div class="md:col-span-1">
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Your Cart</h3>
                                <span class="bg-blue-500 text-white px-2 py-1 rounded-full text-sm"
                                    x-text="`${items.length} Items`"></span>
                            </div>

                            <div class="space-y-4">
                                <!-- Cart Items -->
                                <template x-for="(item, index) in items" :key="index">
                                    <div class="border-b dark:border-gray-600 pb-4">
                                        <div class="flex justify-between items-start">
                                            <div>
                                                <h4 class="font-medium text-gray-800 dark:text-white"
                                                    x-text="item.name"></h4>
                                                <p class="text-sm text-gray-500 dark:text-gray-400"
                                                    x-text="item.description"></p>
                                            </div>
                                            <div class="flex items-center space-x-2">
                                                <span class="text-gray-600 dark:text-gray-300"
                                                    x-text="`${item.price} TK`"></span>
                                                <button @click="removeItem(index)"
                                                    class="text-red-500 hover:text-red-700">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </template>

                                <!-- Total -->
                                <div class="flex justify-between items-center pt-4">
                                    <span class="font-semibold text-gray-800 dark:text-white">Total</span>
                                    <span class="font-bold text-lg text-blue-600 dark:text-blue-400"
                                        x-text="`${total} TK`"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Billing Form -->
                    <div class="md:col-span-2">
                        <form action="{{ route('hosted.pay') }}" method="POST" class="space-y-6">
                            @csrf
                            <div class="bg-white dark:bg-gray-800 rounded-lg p-6 shadow-sm">
                                <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-6">Billing Details
                                </h3>

                                <!-- Name Field -->
                                <div class="mb-4">
                                    <label for="customer_name"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Full Name
                                    </label>
                                    <input type="text" name="customer_name" id="customer_name"
                                        x-model="formData.customerName" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700
                                        dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                </div>

                                <!-- Mobile Field -->
                                <div class="mb-4">
                                    <label for="mobile"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Mobile Number
                                    </label>
                                    <div class="flex">
                                        <span
                                            class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300
                                            dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-300">
                                            +88
                                        </span>
                                        <input type="text" name="customer_mobile" id="mobile"
                                            x-model="formData.customerMobile" class="flex-1 rounded-r-md border-gray-300 dark:border-gray-600 dark:bg-gray-700
                                            dark:text-white focus:border-blue-500 focus:ring-blue-500" required>
                                    </div>
                                </div>

                                <!-- Email Field -->
                                <div class="mb-4">
                                    <label for="email"
                                        class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">
                                        Email Address
                                    </label>
                                    <input type="email" name="customer_email" id="email"
                                        x-model="formData.customerEmail" class="w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700
                                        dark:text-white shadow-sm focus:border-blue-500 focus:ring-blue-500" required>
                                </div>

                                <!-- Hidden Amount -->
                                <input type="hidden" name="amount" x-model="total" />

                                <!-- Submit Button -->
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4
                                    rounded-md transition duration-200 ease-in-out transform hover:-translate-y-1">
                                    Proceed to Payment
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('scripts')
    <!-- Alpine.js Script -->
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('cart', () => ({
                items: [
                    { name: 'Product name', description: 'Brief description', price: 1000 },
                    { name: 'Second product', description: 'Brief description', price: 50 },
                    { name: 'Third item', description: 'Brief description', price: 150 }
                ],
                formData: {
                    customerName: 'Tarik Manoar',
                    customerMobile: '01945606060',
                    customerEmail: 'tarik@duck.com'
                },
                get total() {
                    return this.items.reduce((sum, item) => sum + item.price, 0);
                },
                removeItem(index) {
                    this.items.splice(index, 1);
                }
            }));
        });
    </script>
    @endpush
</x-app-layout>
