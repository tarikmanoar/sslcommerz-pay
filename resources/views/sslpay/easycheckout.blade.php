<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Easy Checkout') }}
        </h2>
    </x-slot>

    <div class="py-12" x-data="checkout">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg">
                <div class="py-8 text-center">
                    <h2 class="text-2xl font-bold text-gray-800 dark:text-white mb-4">EasyCheckout (Popup) - SSLCommerz</h2>
                    <p class="text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
                        Sample form for understanding EasyCheckout (Popup) Payment integration with SSLCommerz.
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 p-6">
                    <!-- Cart Summary -->
                    <div class="md:col-span-1">
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-lg font-semibold text-gray-800 dark:text-white">Your Cart</h3>
                                <span class="px-3 py-1 bg-blue-500 text-white rounded-full text-sm">3 items</span>
                            </div>

                            <div class="space-y-4">
                                <!-- Cart Items -->
                                <template x-for="(item, index) in cartItems" :key="index">
                                    <div class="flex justify-between items-center py-3 border-b border-gray-200 dark:border-gray-600">
                                        <div>
                                            <h4 class="font-medium text-gray-800 dark:text-white" x-text="item.name"></h4>
                                            <p class="text-sm text-gray-500 dark:text-gray-400" x-text="item.description"></p>
                                        </div>
                                        <span class="font-semibold" x-text="item.price + ' TK'"></span>
                                    </div>
                                </template>

                                <!-- Total -->
                                <div class="flex justify-between items-center pt-4">
                                    <span class="text-lg font-bold text-gray-800 dark:text-white">Total</span>
                                    <span class="text-lg font-bold text-blue-600 dark:text-blue-400" x-text="total + ' TK'"></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Billing Form -->
                    <div class="md:col-span-2">
                        <form class="space-y-6">
                            <!-- Full Name -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Full Name</label>
                                <input type="text" x-model="formData.customer_name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <!-- Mobile -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mobile</label>
                                <div class="mt-1 flex rounded-md shadow-sm">
                                    <span class="inline-flex items-center px-3 rounded-l-md border border-r-0 border-gray-300 bg-gray-50 text-gray-500 text-sm">
                                        +88
                                    </span>
                                    <input type="text" x-model="formData.customer_mobile"
                                        class="flex-1 block w-full rounded-none rounded-r-md border-gray-300 focus:border-blue-500 focus:ring-blue-500">
                                </div>
                            </div>

                            <!-- Email -->
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Email <span class="text-gray-400">(Optional)</span>
                                </label>
                                <input type="email" x-model="formData.customer_email"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            </div>

                            <!-- Address -->
                            <div class="grid grid-cols-1 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Address</label>
                                    <input type="text" x-model="formData.address"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                </div>

                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Country</label>
                                        <select x-model="formData.country"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                            <option value="">Select...</option>
                                            <option value="Bangladesh">Bangladesh</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">State</label>
                                        <select x-model="formData.state"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                            <option value="">Select...</option>
                                            <option value="Dhaka">Dhaka</option>
                                        </select>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">ZIP</label>
                                        <input type="text" x-model="formData.zip"
                                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    </div>
                                </div>
                            </div>

                            <!-- Checkboxes -->
                            <div class="space-y-4">
                                <label class="flex items-center">
                                    <input type="checkbox" x-model="formData.sameAddress"
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                                        Shipping address is the same as billing address
                                    </span>
                                </label>
                                <label class="flex items-center">
                                    <input type="checkbox" x-model="formData.saveInfo"
                                        class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                                        Save this information for next time
                                    </span>
                                </label>
                            </div>

                            <!-- Submit Button -->
                            <button
                                class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500"
                                id="sslczPayBtn"
                                token="if you have any token validation"
                                postdata="your javascript arrays or objects which requires in backend"
                                order="If you already have the transaction generated for current order"
                                endpoint="{{ url('/pay-via-ajax') }}"
                            >
                                Pay Now
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('checkout', () => ({
            cartItems: [
                { name: 'Product name', description: 'Brief description', price: 1000 },
                { name: 'Second product', description: 'Brief description', price: 50 },
                { name: 'Third item', description: 'Brief description', price: 150 }
            ],
            formData: {
                customer_name: 'John Doe',
                customer_mobile: '01945606060',
                customer_email: 'you@duck.com',
                address: '93 B, New Eskaton Road',
                country: '',
                state: '',
                zip: '',
                sameAddress: false,
                saveInfo: false
            },
            init() {
                this.submitForm();
                this.loadSSLCZ();
            },
            get total() {
                return this.cartItems.reduce((sum, item) => sum + item.price, 0)
            },
            async submitForm() {
                const postData = {
                cus_name: this.formData.customer_name,
                cus_phone: this.formData.customer_mobile,
                cus_email: this.formData.customer_email,
                cus_addr1: this.formData.address,
                amount: this.total
                };
                // Initialize payment
                document.getElementById('sslczPayBtn').setAttribute('postdata', JSON.stringify(postData));
            },
            loadSSLCZ() {
                // Load SSL Commerz script
                const script = document.createElement('script');

                @if (app()->environment('production'))
                script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
                @else
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
                @endif

                document.body.appendChild(script);
            }
            }))
        })
    </script>
    @endpush
</x-app-layout>
