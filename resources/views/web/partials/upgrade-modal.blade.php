<!-- Upgrade Modal - Trigger with onclick="showUpgradeModal('pro')" or showUpgradeModal('compliance') -->
<div id="upgradeModal" class="fixed inset-0 z-50 hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog"
    aria-modal="true">
    <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" onclick="closeUpgradeModal()"></div>
        <div
            class="relative inline-block bg-white rounded-lg px-6 pt-6 pb-8 text-left overflow-hidden shadow-xl transform transition-all sm:max-w-lg sm:w-full sm:p-8">
            <div class="absolute top-0 right-0 pt-4 pr-4">
                <button onclick="closeUpgradeModal()" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-yellow-100 mb-4">
                    <svg class="h-8 w-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2" id="modal-title">🔒 Upgrade Required</h3>
                <p class="text-gray-600 mb-6" id="modal-description">This feature is part of the <strong
                        id="modal-plan-name">Pro Plan</strong>.</p>
            </div>
            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <h4 class="font-semibold text-gray-700 mb-3 text-sm">Unlock:</h4>
                <ul class="space-y-2" id="modal-features-list">
                    <!-- Dynamically populated -->
                </ul>
            </div>
            <div class="flex flex-col sm:flex-row gap-3">
                <a id="modal-upgrade-btn" href="#"
                    class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg text-center transition-colors">Upgrade
                    Now</a>
                <button onclick="closeUpgradeModal()"
                    class="flex-1 border border-gray-300 hover:border-gray-400 text-gray-700 font-semibold px-6 py-3 rounded-lg transition-colors">Maybe
                    Later</button>
            </div>
        </div>
    </div>
</div>

<script>
    function showUpgradeModal(planSlug) {
        var plans = {
            'pro': {
                name: 'Pro Plan',
                features: ['Full compliance calendar', 'Annual report reminders', 'EIN assistance',
                    'Registered agent discount'
                ]
            },
            'compliance': {
                name: 'Business Compliance Plan',
                features: ['Compliance monitoring', 'Multi-state reminders', 'Auto-filled forms',
                    'Everything in Pro'
                ]
            }
        };
        var plan = plans[planSlug];
        if (!plan) return;
        document.getElementById('modal-plan-name').textContent = plan.name;
        var list = document.getElementById('modal-features-list');
        list.innerHTML = '';
        plan.features.forEach(function(f) {
            var li = document.createElement('li');
            li.className = 'flex items-center text-sm text-gray-600';
            li.innerHTML =
                '<svg class="w-4 h-4 text-green-500 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg> ' +
                f;
            list.appendChild(li);
        });
        document.getElementById('modal-upgrade-btn').href = '/pricing?plan=' + planSlug;
        document.getElementById('upgradeModal').classList.remove('hidden');
    }

    function closeUpgradeModal() {
        document.getElementById('upgradeModal').classList.add('hidden');
    }
</script>
