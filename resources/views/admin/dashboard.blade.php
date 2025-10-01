<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <p>Selamat Datang Admin!</p>

                <!-- Trigger button -->
                <button 
                    id="openModalBtn" 
                    class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Show Modal
                </button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div 
        id="myModal"
        class="hidden fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 z-50"
    >
        <div class="bg-white rounded-lg shadow-lg w-96 p-6 relative">
            <h2 class="text-lg font-bold mb-4">Modal Title</h2>
            <p>This is a DOM-based modal without Alpine.js.</p>

            <div class="mt-4 flex justify-end space-x-2">
                <button 
                    id="closeModalBtn" 
                    class="px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400">
                    Cancel
                </button>
                <button 
                    id="okModalBtn"
                    class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    OK
                </button>
            </div>

            <button 
                id="xCloseModalBtn"
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700">
                ✕
            </button>
        </div>
    </div>

    <div class="p-6">
        <h2 class="text-xl font-bold mb-4">Preferences</h2>
        <div class="mb-4">
        <label class="block font-semibold">Choose a plan:</label>
        <label><input type="radio" name="plan" value="basic"> Basic</label>
        <label><input type="radio" name="plan" value="pro"> Pro</label>
        <label><input type="radio" name="plan" value="enterprise"> Enterprise</label>
        </div>
        
        <div class="mb-4">
        <label class="block font-semibold">Add-ons:</label>
        <label><input type="checkbox" name="addons" value="support"> Extra Support</label>
        <label><input type="checkbox" name="addons" value="storage"> Cloud Storage</label>
        <label><input type="checkbox" name="addons" value="analytics"> Advanced Analytics</label>
        </div>

        <button id="submitBtn" class="px-4 py-2 bg-blue-600 text-white rounded">Submit</button>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const modal = document.getElementById("myModal");
            const openBtn = document.getElementById("openModalBtn");
            const closeBtn = document.getElementById("closeModalBtn");
            const xCloseBtn = document.getElementById("xCloseModalBtn");
            const okBtn = document.getElementById("okModalBtn");

            openBtn.addEventListener("click", () => {
                modal.classList.remove("hidden");
            });

            [closeBtn, xCloseBtn, okBtn].forEach(btn => {
                btn.addEventListener("click", () => {
                    modal.classList.add("hidden");
                });
            });

            modal.addEventListener("click", (e) => {
                if (e.target === modal) {
                    modal.classList.add("hidden");
                }
            });
        });

        document.addEventListener("DOMContentLoaded", () => {
            const submitBtn = document.getElementById("submitBtn");

            submitBtn.addEventListener("click", () => {
                const selectedPlan = document.querySelector("input[name='plan']:checked")?.value;

                const selectedAddons = Array.from(document.querySelectorAll("input[name='addons']:checked"))
                                        .map(cb => cb.value);

                console.log("Plan:", selectedPlan);
                console.log("Add-ons:", selectedAddons);

                fetch("/dashboard/admin/test/preferences", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content")
                },
                body: JSON.stringify({
                    plan: selectedPlan,
                    addons: selectedAddons
                })
                })
                .then(res => res.json())
                .then(data => {
                alert("Response from server: " + JSON.stringify(data));
                })
                .catch(err => console.error(err));
            });
        });
    </script>
</x-app-layout>
