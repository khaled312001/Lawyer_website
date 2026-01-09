@extends('layouts.client.layout')
@section('title')
    <title>{{ __('Legal Aid Check') }} - {{ $setting?->app_name }}</title>
@endsection
@section('meta')
    <meta name="description" content="{{ __('Check if you are eligible for legal aid or legal protection insurance') }}">
@endsection
@section('client-content')

<!--Page Title Start-->
<section class="page-title-area" style="background-image: url({{ $setting?->breadcrumb_image ? url($setting->breadcrumb_image) : asset('client/img/shape-2.webp') }})">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="page-title-content">
                    <h2 class="title">{{ __('Legal Aid Check') }}</h2>
                    <ul>
                        <li><a href="{{ route('home') }}">{{ __('Home') }}</a></li>
                        <li>{{ __('Legal Aid Check') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Page Title End-->

<!--Legal Aid Check Start-->
<section class="legal-aid-check-area pt_100 pb_100">
    <div class="container">
        <div class="row">
            <div class="col-md-11 col-lg-8 col-xl-7 m-auto wow fadeInDown">
                <div class="main-headline text-center">
                    <h2 class="title"><span>{{ __('Are you eligible') }}</span> {{ __('for legal aid?') }}</h2>
                    <p>{{ __('If you need a lawyer for legal assistance, you may be eligible to have part of the cost covered through legal protection insurance or government-funded legal aid. This means you could receive financial support to cover a portion of your lawyer\'s fees—provided you meet certain criteria.') }}</p>
                </div>
            </div>
        </div>

        <div class="row mt_50">
            <div class="col-lg-8 m-auto">
                <div class="legal-aid-check-form">
                    <h3 class="text-center mb_40">{{ __('Find out now') }}</h3>
                    <form id="legalAidCheckForm" class="check-form" action="{{ route('website.legal-aid-check.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>{{ __('What type of legal assistance do you need?') }}</label>
                            <select name="legal_issue_type" class="form-control" required>
                                <option value="">{{ __('Select type') }}</option>
                                <option value="family">{{ __('Family Law') }}</option>
                                <option value="employment">{{ __('Employment Law') }}</option>
                                <option value="criminal">{{ __('Criminal Law') }}</option>
                                <option value="immigration">{{ __('Immigration Law') }}</option>
                                <option value="business">{{ __('Business Law') }}</option>
                                <option value="property">{{ __('Property Law') }}</option>
                                <option value="other">{{ __('Other') }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>{{ __('Do you have legal protection insurance?') }}</label>
                            <div class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="has_insurance" value="yes" required>
                                    <span>{{ __('Yes') }}</span>
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="has_insurance" value="no" required>
                                    <span>{{ __('No') }}</span>
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="has_insurance" value="unsure" required>
                                    <span>{{ __('Not sure') }}</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>{{ __('What is your approximate monthly income?') }}</label>
                            <select name="income_range" class="form-control" required>
                                <option value="">{{ __('Select range') }}</option>
                                <option value="low">{{ __('Below average') }}</option>
                                <option value="average">{{ __('Average') }}</option>
                                <option value="above_average">{{ __('Above average') }}</option>
                                <option value="high">{{ __('High') }}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>{{ __('Are you currently employed?') }}</label>
                            <div class="radio-group">
                                <label class="radio-label">
                                    <input type="radio" name="employment_status" value="employed" required>
                                    <span>{{ __('Yes, employed') }}</span>
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="employment_status" value="unemployed" required>
                                    <span>{{ __('No, unemployed') }}</span>
                                </label>
                                <label class="radio-label">
                                    <input type="radio" name="employment_status" value="self_employed" required>
                                    <span>{{ __('Self-employed') }}</span>
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>{{ __('Your Name') }}</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>{{ __('Your Email') }}</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>{{ __('Your Phone') }}</label>
                            <input type="tel" name="phone" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-lg w-100">{{ __('Check Eligibility') }}</button>
                        </div>
                    </form>

                    <div id="eligibilityResult" class="eligibility-result d-none mt_40">
                        <div class="result-content">
                            <h4 id="resultTitle"></h4>
                            <p id="resultDescription"></p>
                            <div id="resultActions" class="mt_30"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt_60">
            <div class="col-lg-4 col-md-6 mt_30">
                <div class="aid-info-card">
                    <div class="aid-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h4>{{ __('Legal Protection Insurance') }}</h4>
                    <p>{{ __('Many insurance policies include legal protection coverage. Check your insurance policy to see if you\'re covered for legal expenses.') }}</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mt_30">
                <div class="aid-info-card">
                    <div class="aid-icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <h4>{{ __('Government Legal Aid') }}</h4>
                    <p>{{ __('Depending on your income and the type of case, you may qualify for government-funded legal aid to help cover legal costs.') }}</p>
                </div>
            </div>

            <div class="col-lg-4 col-md-6 mt_30">
                <div class="aid-info-card">
                    <div class="aid-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <h4>{{ __('Need Help?') }}</h4>
                    <p>{{ __('Our team can help you understand your options and guide you through the process of applying for legal aid or using your insurance.') }}</p>
                    <a href="{{ route('website.contact-us') }}" class="btn btn-sm btn-primary mt_20">{{ __('Contact Us') }}</a>
                </div>
            </div>
        </div>
    </div>
</section>
<!--Legal Aid Check End-->

@push('js')
<script>
    document.getElementById('legalAidCheckForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const form = this;
        const formData = new FormData(form);
        const submitButton = form.querySelector('button[type="submit"]');
        const originalButtonText = submitButton.textContent;
        
        // Disable submit button
        submitButton.disabled = true;
        submitButton.textContent = '{{ __("Processing...") }}';
        
        // Send AJAX request
        fetch(form.action, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || formData.get('_token')
            }
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(err => Promise.reject(err));
            }
            return response.json();
        })
        .then(data => {
            if (!data.success) {
                throw new Error(data.message || '{{ __("An error occurred") }}');
            }
            
            const resultDiv = document.getElementById('eligibilityResult');
            const resultTitle = document.getElementById('resultTitle');
            const resultDescription = document.getElementById('resultDescription');
            const resultActions = document.getElementById('resultActions');
            
            resultDiv.classList.remove('d-none');
            
            if (data.eligible) {
                resultTitle.textContent = '{{ __("You may be eligible!") }}';
                resultDescription.textContent = data.message;
                resultActions.innerHTML = `
                    <a href="{{ route('website.contact-us') }}" class="btn btn-primary">{{ __('Contact Us Now') }}</a>
                    <a href="{{ route('website.lawyers') }}" class="btn btn-outline-primary">{{ __('Browse Lawyers') }}</a>
                `;
            } else {
                resultTitle.textContent = '{{ __("Let\'s discuss your options") }}';
                resultDescription.textContent = data.message;
                resultActions.innerHTML = `
                    <a href="{{ route('website.contact-us') }}" class="btn btn-primary">{{ __('Get a Quote') }}</a>
                    <a href="{{ route('website.lawyers') }}" class="btn btn-outline-primary">{{ __('View Our Services') }}</a>
                `;
            }
            
            // Scroll to result
            resultDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            
            // Reset form
            form.reset();
        })
        .catch(error => {
            console.error('Error:', error);
            const errorMessage = error.message || '{{ __("An error occurred. Please try again.") }}';
            alert(errorMessage);
        })
        .finally(() => {
            // Re-enable submit button
            submitButton.disabled = false;
            submitButton.textContent = originalButtonText;
        });
    });
</script>
@endpush

@endsection

