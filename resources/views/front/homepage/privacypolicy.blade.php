@extends('front.homepage.layout.app')
@section('title', 'Privacy Policy')
@section('content')
        <section class="viewhistory-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-1"></div>
                    <div class="col-lg-10">
                        <div class="news_archieve_wrapper mt-0 terms_page">
                            @if ($errors->any())
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-danger w-50">
                                        <strong>{{ $error }}</strong>
                                    </div>
                                @endforeach
                            @endif
                            @if (Session::has('successful_message'))
                                <div class="alert alert-success w-50">
                                    {{ Session::get('successful_message') }}
                                </div>
                            @endif
                            @if(Auth::check())
                                <a href="{{ route('sendmail') }}" class="btn btn-success mt-4">Request to Personal Data</a>
                            @endif
                            <div class="terms_privacy page1">
                                <span class="d-none">page : privacy policy</span>
                                <span class="d-none">content start</span>
                                <strong>Introduction:</strong>
                                <p>Please read the following Privacy Policy (henceforth the "policy") carefully. The policy sets out how FibreEclipse (henceforth referred to as "we" etc), uses and protects your information. This privacy policy applies to your use of VoreCentral (henceforth the "Website") and all of its subdomains. By using or accesing thís Website, you aknowledge that  that you have read, understood, and agree to this Privacy Policy as well as our Terms of Service.  Any information you provide will be used in accordance with this Privacy Policy.</p>
                                <p>FibreEclipse reserves the right to amend this Policy at any time without notice. It is your responsibility to review this Policy for any changes. If you continue to use the Webstie following any amendment you will be deemed to have accepted the revised Policy.</p>

                                <strong>1. What data do we collect:</strong>
                                <p>We may collect different kinds of personal data about you, depending on whether you chose to create an account with us.</p>
                                <p>Persons who visit the Website without logging in or registering (“unregistered users”):</p>
                                <p>Contact Information: We collect email address or any other information which you voluntarily provide to us at your direction for a specific function, for example a purchase or competition.</p>
                                <p>Website activity data: We collect information about how you use the Website, products and services and interact with our content and advertisements, including the pages you visit in the Websites, search history, and the referring web page from which you arrived at the Website. We collect browser and operating system information, devices you use to access the Website and your time zone setting. We also collect online identifiers. Specifically, we collect internet protocol (IP) address information and we set cookies as explained below in the section on Cookies and Automatic Data Collection Technologies</p>
                                <p>* Persons who choose to create an account on VoreCentral, including persons who sign up in the Creator Program (“registered users”):</p>
                            </div>
                            <div class="terms_privacy page2" style="display: none;">
                                <p>We collect from registered users the same categories of information described above for unregistered users.</p>
                                <p>Contact Information: We collect username or similar identifier, and email address.</p>
                                <p>Payment and Commercial Information: If you make a purchase, or receive payments from us (such as through our Creator Program), we collect payment card or account details and related information necessary to process payments. We also collect details about payments to and from you and details of products and services you have purchased or received from us.</p>
                                <p>User Submitted Personal Information: We collect information you submit in order to personalize your account or for a specific function, for example date of birth, age, gender, your interests, preferences, feedback, survey responses, your preferences in receiving marketing from us and our third parties, and your communication preferences, as well as any other information which you voluntarily provide to us at your direction for a specific function. Users are also able to choose tags which may identify their sexual interest. These are stored on the website, in order to provide users with an optimal browsing experience.</p>
                                <p>User Contributions including Audio/Video Information: We provide areas on our Website where you can post information about yourself and others, communicate with others, upload content (e.g., pictures, video files, etc.), and post comments or reviews of content found on the Website.</p>
                                <p>Please use caution in providing user contributions. By providing user contributions you are making that content and information publicly available. User contributions can be read, collected, used, and disclosed by others, and we cannot control who accesses your user contributions or what other users may do with the information you voluntarily post or submit. User contributions are governed by the VoreCentral Terms of use found at https://www.vorecentral.com/information/terms.</p>
                                <p>We may use your data to produce and share aggregated insights that do not directly or indirectly identify you and are not associated with you. Such aggregate information is not personal information.</p>
                                <p>Our Websites are not directed to persons under the age of 18 or the applicable age of majority in the jurisdiction from which the Website is accessed (“minors”), and we prohibit minors from using the Website. We do not knowingly collect personal information from minors. If you are the parent or legal guardian of a minor who has provided us with personal information, then please contact us at support@fibreeclipse.com to have that minor’s personal information deleted.</p>
                            </div>
                            <div class="terms_privacy page3" style="display: none;">
                                <strong>2. What do we do with the data we collect:</strong>
                                <p>We use personal information for the purposes described below.</p>
                                <p>Provision of services: We use identifiers, website activity data, and, additionally, for registered users only, contact information, and payment and commercial information and user contributions to present our Website and their contents to you, including any interactive features on our Website, to provide you with information, products or services that you request from us, and to verify your eligibility and deliver prizes in connection with contests and sweepstakes.</p>
                                <p>Customer management (Registered Users and Premium Users Only): We use identifiers and contact information, and payment and commercial information to manage registered users’ account, to provide customer support and notices to the registered user about his account or subscription, including expiration and renewal notices, and notices about changes to our Website or any products or services we offer or provide through them.</p>
                                <p>Customization of content and marketing (Unregistered Users and Registered Users Only): We use identifiers and contact information, website activity data, user submitted personal information and user contributions to analyze your use of, or interest in, our Website’s content, products, or services, in order to develop and display content and advertising tailored to your interests on our Website.</p>
                                <p><strong>Analytics:</strong> We use identifiers and website activity data to determine whether users of our Website are unique, or whether the same user is using the Website on multiple occasions, and to monitor aggregate metrics such as total number of visitors, pages viewed, demographic patterns.</p>
                                <p>Functionality and security: We may use any of the categories of data we collect to diagnose or fix technology problems, to verify your payment information, and to detect, prevent, and respond to actual or potential fraud, illegal activities, or intellectual property infringement.</p>
                                <p>Compliance: We may use any of the categories of data we collect to enforce our terms and conditions and to comply with our legal obligations.</p>
                                <p>We will use contact information and user submitted personal information in any other way we may describe when you provide the information (e.g., for a purchase); or for any other purpose with your consent provided separately from this privacy policy.</p>
                            </div>
                            <div class="terms_privacy page4" style="display: none;">
                                <strong>3. Disclosure of your personal information:</strong>
                                <p>We disclose personal information:</p>
                                <p>To the public: When you submit user contributions including audio/video content, you are using our Website and services to make that information public.</p>
                                <p>Within our corporate group: We may disclose any of the categories of personal information to members of our corporate group (including affiliates and related entities) to the extent this is necessary for our purposes listed in the sections above.</p>
                                <p><strong>Service providers: </strong> We disclose the categories of personal information we collect to our authorized service providers that perform certain services on our behalf. These services may include payment processing and fulfilling orders, identity and document authenticity verification including biometric processing, risk and fraud detection and mitigation, customer service, marketing and advertising, customization of content, analytics, security, or hosting our Website or supporting our Website’s functionality. These service providers may have access to personal information needed to perform their functions but are not permitted to share or use such information for any other purposes.</p>
                                <p>Legal successors: We may disclose all of the categories of personal information we collect to a buyer or other successor in the event of a merger, acquisition or sale or transfer of some or all of our assets, whether as a going concern or as part of bankruptcy, liquidation or similar proceeding.</p>
                                <p>To comply with the law or protect our rights or the rights of third parties: We access, preserve and share all of the categories of personal information with regulators, law enforcement or others where we reasonably believe such disclosure is needed to (a) satisfy any applicable law, regulation, legal process, or governmental request, (b) enforce applicable terms of use, including investigation of potential violations thereof, (c) detect, prevent, or otherwise address illegal or suspected illegal activities, security or technical issues, (d) protect against harm to the rights, property or safety of our company, our users, our employees, or others; or (e) to maintain and protect the security and integrity of the Website or its infrastructure. In such cases, we may raise or waive any legal objection or right available to us, in our sole discretion.</p>
                            </div>
                            <div class="terms_privacy page5" style="display: none;">
                                <strong>4. Cookies and such technology:</strong>
                                <p>As you navigate through and interact with our Website, we use automatic data collection technologies to collect website activity data.</p>
                                <p>We use cookies, which are small text files that are stored in your web browser or downloaded to your device when you visit a website.</p>
                                <p>We currently use the following types of cookies, which are set by the Website’s domains, or by other domains we own or control:</p>
                                <p>Strictly necessary cookies: These are cookies that are required for the operation of our Website. These include, for example, cookies that enable a user to log in to our Website and to check if a user is allowed access to a particular service or content.</p>
                                <p>Functionality cookies: These cookies help us to personalize and enhance your online experience on our Website. This type of cookies allows us to recognize you when you return to our Website and to remember, for example, your choice of language.</p>
                                <p>Analytics cookies: These cookies allow us to recognize and count the number of users and to see how users use and explore our Website. These cookies help us to improve our Website, for example by ensuring that all users are able to find what they are looking for easily.</p>
                                <p>Targeting and Advertising cookies: These cookies record visits of a user on our Website, the pages a user visits and the links a user follows in order to enable us to make our Website more relevant to the user’s interests and to help us serve ads that might be of interest to the user. Targeting and advertising cookies are only used for unregistered users and registered users.</p>
                                <p>Cookies can be either session cookies or persistent cookies. A session cookie expires automatically when you close your browser. A persistent cookie will remain until it expires or you delete your cookies.</p>
                                <p>You can set your browser to refuse all or some browser cookies, or to alert you when cookies are being sent. If you disable or refuse cookies, please note that some parts of the Websites may then be inaccessible or not function properly.</p>
                                <p><strong>Do Not Track:</strong> Our systems do not recognize browser “Do Not Track” signals.</p>
                                <p>Use of Google Analytics. We use Google as a service provider to collect and analyze information about how users use the Websites, including by collecting website activity data through first-party cookies set by our domains, and third-party cookies set by Google. Because we activated IP anonymization for Google Analytics, Google will anonymize the last octet of a particular IP address and will not store your full IP address. Google will use the information only for the purpose of providing Google Analytics services to us, and will not use this information for other purposes. The information collected by Google Analytics may be transmitted to and stored by Google on servers in the United States pursuant to standard contractual clauses approved by the EU. You can learn more on how Google uses data here, and you can opt-out of Google Analytics by visiting the Google Analytics opt-out page.</p>
                                <h3>^^(change if we do not go with google)</h3>
                            </div>
                            <div class="terms_privacy page6" style="display: none;">
                                <strong>5. Third-parties:</strong>
                                <p>* Links to other websites:</p>
                                <p>VoreCentral, any associated websites and sub-domains, may contain links to other websites. These websites may or may not be affiliated with VoreCentral.</p>
                                <p>VoreCentral has no control over any external websites therefore clicking any link which results in you visiting an external website will result in this privacy policy no longer applying and VoreCentral cannot be held responsible for the protection and privacy of any information which you provide whilst visiting such sites.</p>
                                <strong>* Third-party Use of Cookies and Other Tracking Technologies:</strong>
                                <p>Some content or applications, including advertisements, on VoreCentral are provided or served by third parties. These third parties may use cookies alone or in conjunction with other tracking technologies to collect information about you when you use VoreCentral. Unless expressly stated otherwise, VoreCentral does not provide any personal information to these third parties, however they may collect information, including your IP address, advertisements you click, time zone setting and location, and information about your browser, operating system and devices you use to access VoreCentral. They may use this information to provide you with interest-based advertising or other targeted content. They may track users across different websites and over time.</p>
                            </div>
                            <div class="terms_privacy page7" style="display: none;">
                                <strong>6. Storage of information</strong>
                                <p>We are committed to ensuring that any information you provide to VoreCentral is secure. In order to prevent unauthorized access or disclosure, we have put in place suitable physical, electronic and managerial procedures to safeguard and secure the information we collect.</p>
                                <p>Your information will be stored on our Servers in Luxembourg. When we transfer personal information to countries outside of the European Economic Area (“EEA”) or other regions with comprehensive data protection laws, we will ensure that the information is transferred in accordance with the applicable laws. Where relevant, our transfers outside the EEA are made pursuant to standard contractual clauses approved for use by the European Union.</p>
                                <p>We will only retain your personal information for as long as your account is active, or for as long as necessary to fulfil the purposes we collected it for, including for the purposes of satisfying any legal, accounting, or reporting requirements.</p>
                                <p>To determine the appropriate retention period for personal data, we consider a number of factors, including what personal data we are processing, the risk of harm from any unauthorised disclosure, why we are processing your personal data and whether we can achieve this outcome by another means without having to process it.</p>
                                <p>Where we no longer need to process your personal information for the purposes set out in this Privacy Policy, we will delete your personal information from our systems.</p>
                                <p>Where permissible, we will also delete your personal information upon your request as explained above in the section below “Your Rights and Choices”.</p>
                            </div>
                            <div class="terms_privacy page8" style="display: none;">
                                <strong>7. Your Rights and Choices</strong>
                                <p>You have certain rights regarding the personal information we collect, use or disclose and that is related to you, including the right:</p>
                                <p>To receive information on the personal information we hold about you and how such personal information is used (right to access);</p>
                                <p>To correct inaccurate personal information concerning you (right to data rectification);</p>
                                <p>To delete/erase your personal information (right to deletion, “right to be forgotten”);</p>
                                <p>To receive the personal information provided by you in a structured, commonly used and machine-readable format and to transmit the personal information to another data controller (right to data portability)</p>
                            </div>
                            <div class="terms_privacy page9" style="display: none;">
                                <p>To object to the use of your personal information where such use is based on our legitimate interests or on public interests (right to object);</p>
                                <p>In some cases, to restrict our use of your personal information (right to restriction of processing); and to withdraw your consent at any time where our processing is based on consent.</p>
                                <p>You may exercise your right to access and deletion using the buttons at the bottom of this page. Additionally, you may, at any time, send us an e-mail at support@fibreeclipse.com to exercise your above rights in accordance with the applicable legal requirements and limitations. If you are located in the European Economic Area or the UK, you have a right to lodge a complaint with your local data protection authority.</p>
                                <p>Please note that unless you have created an account with us, we may not have sufficient information to identify you and therefore may not be in a position to respond to your request. Additionally, in some cases in order to adequately verify your identity or your authorization to make the request, we may require you to provide additional information.</p>
                                <p>Note that some requests to delete certain personal information will require the deletion of your user account as the provision of user accounts are inextricably linked to the use of certain personal information (e.g., your e-mail address).</p>
                                <strong>How to exercise your rights:</strong>
                                <p>It is imperative that you will have control over your Information. That is the reason why we are taking reasonable steps in order to enable you to access, receive a copy of, update, amend, delete, or limit the use of your Information.</p>
                                <p>We may ask you for additional information to confirm your identity and for security purposes, before disclosing the requested data to you. We reserve the right to charge a fee where permitted by law, for instance if your request is manifestly unfounded or excessive.</p>
                                <p>You have the right to lodge a complaint with your local supervisory authority for data protection (but we still recommend you to contact us first).</p>
                                <p>For all VoreCentral Users, if you may review and amend your Information by logging in and navigating to your  Settings page on the website. Once there, you may modify information that is incorrect and delete certain information from your profile. You can also change your permission settings for us to send you e-mail newsletters.</p>
                                <p>For all VoreCentral Users, if you wish to retrieve your VoreCentral Account data or permanently delete your VoreCentral data, please send us an E-mail at support@fibreeclipse.com.</p>
                            </div>
                            <div class="terms_privacy page10" style="display: none;">
                                <p>In addition, feel free to send us any e-mails to support@fibreeclipse.com. We will make all reasonable efforts to honor your request promptly (unless we require further information fromyou in order to fulfil your request) subject to legal and other permissible considerations.</p>
                                <p>Please note that permanently deleting your Account erases all of your information from our databases. After completing this process, you can no longer use any of your Services, your Account and all its data will be removed permanently, and we will not be able to restore your Account or retrieve your data in the future. If you contact VoreCentral Support in the future, the system will not recognize your Account and support agents will not be able to locate the deleted Account. Your forum posts will however be retained and stay up on the forum.</p>
                                <p>Your Choices About How We Collect, Use and Disclose Your Personal Information:</p>
                                <p>We strive to provide you with choices regarding the personal information you provide to us.</p>
                                <p>You can choose not to provide us with certain personal information, but that may result in you being unable to use certain features of the Website because such information may be required in order for you to register as a member; purchase products or services; participate in a contest, promotion, survey, or sweepstakes; ask a question; or initiate other transactions in the Webstore.</p>
                                <p>As explained in the section Cookies and Automatic Data Collection Technologies, you may set your browser to refuse some or all cookies. In addition, you may opt out of Google Analytics by visiting the Google Analytics opt-out page.</p>
                                <p>You can opt out of receiving marketing emails from us using the opt-out link provided in our emails. If you are a Registered User, we may continue to send you other types of transactional and relationship e-mail communications, such as emails about your account or orders, administrative notices, and surveys.</p>
                                <p>You may use your account settings to delete your user contributions and audio/video information.</p>
                                <p>You may also delete and deactivate your account with us at any time. If you do so, your profile will no longer be accessible by you. If you later choose to have an account with us, you will have to sign up for a new account as none of the information you previously provided or saved within your account will have been saved.</p>
                                <p>In accordance with the General Data Protection Regulation law in the European Union effective May 25, 2018, VoreCentral users can request a copy of their personal data as well as get VoreCentral to delete their personal data. </p>
                            </div>
                            <span class="d-none">content end</span>
                            <div class="pagination_subforums my-4 text-center" >
                                <ul class="list-none">
                                    <li class="pagination_page" data-page="1">1</li>
                                    <li class="pagination_page" data-page="2">2</li>
                                    <li class="pagination_page" data-page="3">3</li>
                                    <li class="pagination_page" data-page="4">4</li>
                                    <li class="pagination_page" data-page="5">5</li>
                                    <li class="pagination_page" data-page="6">6</li>
                                    <li class="pagination_page" data-page="7">7</li>
                                    <li class="pagination_page" data-page="8">8</li>
                                    <li class="pagination_page" data-page="9">9</li>
                                    <li class="pagination_page" data-page="10">10</li>
                                </ul>
                            </div>

                            <div class="news_adsquare contact_ad mx-auto" style="margin-top: 10px;">
                                <div class="ad_banner landscape">
                                    <div data-banner-id="425470"></div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-1">
                    </div>
                </div>
            </div>
        </section>
@endsection
@push('script')
    <script>
        $('.pagination_page').click(function(){
            var page = $(this).data('page');
            $('.terms_privacy').hide();
            $('.page'+page).show();
        })
    </script>
@endpush
