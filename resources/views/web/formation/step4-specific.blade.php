@extends('web.layouts.app')
@section('title', 'Step 4 - Entity Specifics')
@section('content')
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                @include('web.formation._progress', ['current' => 4])
                <div class="bg-white rounded-lg shadow-sm p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-2">Entity-Specific Information</h2>
                    <p class="text-gray-600 mb-6">Additional details based on your selected entity type.</p>
                    <form method="POST" action="{{ route('formation.step4.post') }}">
                        @csrf

                        @if ($entityType === 'llc')
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Membership Type</label>
                                    <select name="membership_type" required
                                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                                        <option value="single-multi"
                                            {{ old('membership_type', session('formation.entity_specific_data.membership_type')) == 'single-multi' ? 'selected' : '' }}>
                                            Single-Member or Multi-Member</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Management Structure</label>
                                    <select name="management_type" required
                                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                                        <option value="member-managed"
                                            {{ old('management_type', session('formation.entity_specific_data.management_type')) == 'member-managed' ? 'selected' : '' }}>
                                            Member-Managed</option>
                                        <option value="manager-managed"
                                            {{ old('management_type', session('formation.entity_specific_data.management_type')) == 'manager-managed' ? 'selected' : '' }}>
                                            Manager-Managed</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="flex items-center space-x-3">
                                        <input type="checkbox" name="needs_operating_agreement" value="1"
                                            {{ old('needs_operating_agreement', session('formation.entity_specific_data.needs_operating_agreement')) ? 'checked' : '' }}
                                            class="h-5 w-5 text-blue-600 rounded">
                                        <span class="text-gray-700">I need an Operating Agreement</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">NAICS Code (optional)</label>
                                    <input type="text" name="naics_code"
                                        value="{{ old('naics_code', session('formation.entity_specific_data.naics_code')) }}"
                                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                                        placeholder="e.g., 541990">
                                </div>
                            </div>
                        @elseif ($entityType === 's-corporation')
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Number of Shareholders</label>
                                    <input type="number" name="shareholders_count"
                                        value="{{ old('shareholders_count', session('formation.entity_specific_data.shareholders_count', 1)) }}"
                                        required min="1" max="100"
                                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="flex items-center space-x-3">
                                        <input type="checkbox" name="all_citizens" value="1"
                                            {{ old('all_citizens', session('formation.entity_specific_data.all_citizens')) ? 'checked' : '' }}
                                            class="h-5 w-5 text-blue-600 rounded">
                                        <span class="text-gray-700">All shareholders are U.S. citizens</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Fiscal Year</label>
                                    <select name="fiscal_year"
                                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                                        <option value="calendar"
                                            {{ old('fiscal_year', session('formation.entity_specific_data.fiscal_year')) == 'calendar' ? 'selected' : '' }}>
                                            Calendar Year</option>
                                        <option value="fiscal"
                                            {{ old('fiscal_year', session('formation.entity_specific_data.fiscal_year')) == 'fiscal' ? 'selected' : '' }}>
                                            Fiscal Year</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="flex items-center space-x-3">
                                        <input type="checkbox" name="needs_2553_election" value="1"
                                            {{ old('needs_2553_election', session('formation.entity_specific_data.needs_2553_election')) ? 'checked' : '' }}
                                            class="h-5 w-5 text-blue-600 rounded">
                                        <span class="text-gray-700">I need S-Corp election (Form 2553) assistance</span>
                                    </label>
                                </div>
                            </div>
                        @elseif ($entityType === 'c-corporation')
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Authorized Shares</label>
                                    <input type="number" name="authorized_shares"
                                        value="{{ old('authorized_shares', session('formation.entity_specific_data.authorized_shares', 1000)) }}"
                                        required min="1"
                                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Par Value ($)</label>
                                    <input type="number" step="0.01" name="par_value"
                                        value="{{ old('par_value', session('formation.entity_specific_data.par_value', 0.01)) }}"
                                        required min="0"
                                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Number of Directors</label>
                                    <input type="number" name="directors_count"
                                        value="{{ old('directors_count', session('formation.entity_specific_data.directors_count', 1)) }}"
                                        required min="1"
                                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="flex items-center space-x-3">
                                        <input type="checkbox" name="needs_bylaws" value="1"
                                            {{ old('needs_bylaws', session('formation.entity_specific_data.needs_bylaws')) ? 'checked' : '' }}
                                            class="h-5 w-5 text-blue-600 rounded">
                                        <span class="text-gray-700">I need Corporate Bylaws assistance</span>
                                    </label>
                                </div>
                            </div>
                        @elseif ($entityType === 'partnership')
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Partnership Type</label>
                                    <select name="partnership_type" required
                                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                                        <option value="general"
                                            {{ old('partnership_type', session('formation.entity_specific_data.partnership_type')) == 'general' ? 'selected' : '' }}>
                                            General Partnership</option>
                                        <option value="limited"
                                            {{ old('partnership_type', session('formation.entity_specific_data.partnership_type')) == 'limited' ? 'selected' : '' }}>
                                            Limited Partnership</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Number of Partners</label>
                                    <input type="number" name="partners_count"
                                        value="{{ old('partners_count', session('formation.entity_specific_data.partners_count', 2)) }}"
                                        required min="2"
                                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                                </div>
                                <div>
                                    <label class="flex items-center space-x-3">
                                        <input type="checkbox" name="needs_partnership_agreement" value="1"
                                            {{ old('needs_partnership_agreement', session('formation.entity_specific_data.needs_partnership_agreement')) ? 'checked' : '' }}
                                            class="h-5 w-5 text-blue-600 rounded">
                                        <span class="text-gray-700">I need a Partnership Agreement</span>
                                    </label>
                                </div>
                            </div>
                        @elseif ($entityType === 'sole-proprietorship')
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">DBA / Trade Name (optional)</label>
                                    <input type="text" name="dba_name"
                                        value="{{ old('dba_name', session('formation.entity_specific_data.dba_name')) }}"
                                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500"
                                        placeholder="Doing Business As">
                                </div>
                                <div>
                                    <label class="flex items-center space-x-3">
                                        <input type="checkbox" name="needs_local_license" value="1"
                                            {{ old('needs_local_license', session('formation.entity_specific_data.needs_local_license')) ? 'checked' : '' }}
                                            class="h-5 w-5 text-blue-600 rounded">
                                        <span class="text-gray-700">I need a local business license</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Tax ID Preference</label>
                                    <select name="tax_id_type" required
                                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                                        <option value="ein"
                                            {{ old('tax_id_type', session('formation.entity_specific_data.tax_id_type')) == 'ein' ? 'selected' : '' }}>
                                            EIN (Employer Identification Number)</option>
                                        <option value="ssn"
                                            {{ old('tax_id_type', session('formation.entity_specific_data.tax_id_type')) == 'ssn' ? 'selected' : '' }}>
                                            SSN (Social Security Number)</option>
                                    </select>
                                </div>
                            </div>
                        @elseif ($entityType === 'professional-entity')
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Profession Type</label>
                                    <select name="profession_type" required
                                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                                        <option value="">-- Select --</option>
                                        <option value="medical"
                                            {{ old('profession_type', session('formation.entity_specific_data.profession_type')) == 'medical' ? 'selected' : '' }}>
                                            Medical</option>
                                        <option value="legal"
                                            {{ old('profession_type', session('formation.entity_specific_data.profession_type')) == 'legal' ? 'selected' : '' }}>
                                            Legal</option>
                                        <option value="accounting"
                                            {{ old('profession_type', session('formation.entity_specific_data.profession_type')) == 'accounting' ? 'selected' : '' }}>
                                            Accounting</option>
                                        <option value="engineering"
                                            {{ old('profession_type', session('formation.entity_specific_data.profession_type')) == 'engineering' ? 'selected' : '' }}>
                                            Engineering</option>
                                        <option value="architecture"
                                            {{ old('profession_type', session('formation.entity_specific_data.profession_type')) == 'architecture' ? 'selected' : '' }}>
                                            Architecture</option>
                                        <option value="other"
                                            {{ old('profession_type', session('formation.entity_specific_data.profession_type')) == 'other' ? 'selected' : '' }}>
                                            Other</option>
                                    </select>
                                </div>
                                <div>
                                    <label class="flex items-center space-x-3">
                                        <input type="checkbox" name="has_license" value="1"
                                            {{ old('has_license', session('formation.entity_specific_data.has_license')) ? 'checked' : '' }}
                                            class="h-5 w-5 text-blue-600 rounded">
                                        <span class="text-gray-700">I have a professional license</span>
                                    </label>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">License Number (if
                                        applicable)</label>
                                    <input type="text" name="license_number"
                                        value="{{ old('license_number', session('formation.entity_specific_data.license_number')) }}"
                                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                                </div>
                            </div>
                        @elseif ($entityType === 'foreign-qualification')
                            <div class="space-y-6">
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Home State (where originally
                                        formed)</label>
                                    <select name="home_state_id" required
                                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                                        <option value="">-- Select --</option>
                                        @foreach (\App\Models\State::where('status', true)->orderBy('name')->get() as $s)
                                            <option value="{{ $s->id }}"
                                                {{ old('home_state_id', session('formation.entity_specific_data.home_state_id')) == $s->id ? 'selected' : '' }}>
                                                {{ $s->state_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-gray-700 font-medium mb-2">Foreign State (where
                                        qualifying)</label>
                                    <select name="foreign_state_id" required
                                        class="w-full border rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500">
                                        <option value="">-- Select --</option>
                                        @foreach (\App\Models\State::where('status', true)->orderBy('name')->get() as $s)
                                            <option value="{{ $s->id }}"
                                                {{ old('foreign_state_id', session('formation.entity_specific_data.foreign_state_id')) == $s->id ? 'selected' : '' }}>
                                                {{ $s->state_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label class="flex items-center space-x-3">
                                        <input type="checkbox" name="has_certificate_of_good_standing" value="1"
                                            {{ old('has_certificate_of_good_standing', session('formation.entity_specific_data.has_certificate_of_good_standing')) ? 'checked' : '' }}
                                            class="h-5 w-5 text-blue-600 rounded">
                                        <span class="text-gray-700">I have a Certificate of Good Standing</span>
                                    </label>
                                </div>
                            </div>
                        @endif

                        <div class="mt-8 flex justify-between">
                            <a href="{{ route('formation.step3') }}"
                                class="text-gray-600 hover:text-gray-800 font-medium px-4 py-3">&larr; Back</a>
                            <button type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-8 py-3 rounded-lg transition-colors">Continue
                                →</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
