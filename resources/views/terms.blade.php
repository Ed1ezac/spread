@extends('layouts.landing-header')

@push('page-css')
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
@endpush

@section('content')
<section class="pt-20">
    <div class="text-gray-700 text-center text-5xl font-medium m-12">Terms of Service</div>
    <div class="py-5">
        <div class="border-t-2 border-gray-200 mx-48 -mt-6"></div>
    </div>
    <div class="px-8 lg:px-20 space-y-12 mb-8">
        <!---Definitions--->
        <div>
            <div class="text-gray-700 text-2xl font-medium">1. Definitions</div>
            <p class="text-gray-500 mb-4">
                This document, titled “Terms of Service” (referred to hereinafter as “Terms”) consists of terms governing the 
                relationship between the Spread | Bulk SMS Service, (hereinafter referred to as “Spread”, “The Service”) and the 
                customer of the service (hereinafter referred to as “customer”, “user”, “you”, “member”). The service referred 
                to being that of, but not limited to, dispatching a short message (hereinafter referred to as an “SMS”) to 
                multiple mobile number recipients in a single automated task.
            </p>
        </div>
        <!---Precondition---->
        <div>
            <div class="text-gray-700 text-2xl font-medium">2. Precondition</div>
            <p class="text-gray-500 mb-4">
                The use of the Spread services is governed by these Terms of Service and the Privacy Policy. The Spread Terms of 
                Service can be corrected or supplemented by the administration without notifying users, and the changes enter 
                into force from the moment that the document is placed on the official website.
            </p>
            <p class="text-gray-500 mb-4">
                By accessing or using the Service in any way you agree to and accept all of these Terms (on behalf of yourself or 
                the entity that you represent), and these Terms will always remain in effect while you use the Service, or any 
                data obtained through the Service. By accessing or using the Service in any way you represent and warrant that 
                you have the right, authority, and capacity to enter into these Terms (on behalf of yourself or the entity that you represent). 
                You represent and warrant that you are of legal age to form a binding contract (or if not, you’ve received your 
                parent’s or guardian’s permission to use the Service and gotten your parent or guardian to agree to these Terms on your behalf). 
                If you’re agreeing to these Terms on behalf of an organization or entity, you represent and warrant that you are 
                authorized to agree to these Terms on that organization or entity’s behalf and bind them to these Terms 
                (in which case, the references to “you” and “your”, in these Terms, except for in this sentence, refer to that organization or entity). 
                If you do not consent to any of the terms, the administration is entitled to deny your use of Spread. 
            </p>
        </div>
        <!---User Registration and Account---->
        <div>
            <div class="text-gray-700 text-2xl font-medium">3. User Registration and Account</div>
            <p class="text-gray-500 mb-4">
                By “account,” the user’s account on his/her personal Dashboard on Spread is meant. Registration is carried out on 
                the official website at <a class="text-accent-800 hover:text-accent-500" href="/register">https://spread.co.bw/register</a>.
            </p>
            <p class="text-gray-500 mb-4">
                During registration, the user fills in required fields with personal information (name, email address) and specifies 
                a password which the user will subsequently use for entering his/her account. The user is not allowed to give his/her 
                username and password to a third party. The user bears full responsibility for the safety of his/her username and password.
            </p>
            <p class="text-gray-500 mb-4">
                The user is obligated to provide valid information during the registration process: customers who provide invalid 
                contact information will be deprived of use of the service. Employees of the Service have the right to demand that 
                the client confirm his/her personal information in order to determine its validity.
            </p>
            <p class="text-gray-500 mb-4">
                All personal information is subject to Spread Terms of Service and 
                <a class="text-accent-800 hover:text-accent-500" href="/privacy">Privacy Policy</a> 
                and can be used by employees of the Service to contact the user according to the Privacy Policy.
            </p>
            <p class="text-gray-500 mb-4">
                When registering, the user provides a personal email address and a personal password for accessing the Service. 
                This information is strictly confidential, kept in an encrypted form, and will not be transmitted to third parties.
            </p>
            <p class="text-gray-500 mb-4">
                After going through the registration process, an account is automatically created for the user. All actions 
                regarding emails, payments, and others such as sender name registrations, shall from this moment be carried out 
                through the account.
            </p>
            <p class="text-gray-500 mb-4">
                Sending out SMS, viewing statistics, making purchases, registering sender names, verifying email addresses, 
                creating SMS templates — all of these actions are carried out by the user in his/her account. The user also 
                uploads the addresses and phone numbers of SMS recipients to his/her account to create address books. All 
                uploaded email addresses and phone numbers are considered the property of the user and are confidential information 
                which is protected by the Privacy Policy of the Spread service.
            </p>
            <p class="text-gray-500 mb-4">
                The administration of the Service has the right to track user activity and, in the event that the user is suspected 
                of sending spam, to temporarily block the account. All administration actions are governed by the Anti-Spam Policy, 
                which the user consents to during account registration.
            </p>
            <p class="text-gray-500 mb-4">
                The user has the right to, at any time, request the deletion of his/her account. Any funds remaining on the account 
                shall not be returned unless there are special grounds for a refund . When making its decision, the Spread service is 
                governed by its Anti-Spam Policy.
            </p>
        </div>
        <!---SMS Creation and Rollout---->
        <div>
            <div class="text-gray-700 text-2xl font-medium">4. SMS Creation and Rollout</div>
            <p class="text-gray-500 mb-4">
                The user has access to an SMS creation form on their personal Dashboard. To create the SMS, the user is required to 
                upload at least one (1) recipient list, which contains all the people for whom the SMS is intended to. The user is 
                then required to purchase a bundle of units corresponding to the number of recipients who will receive the SMS, 
                which will be used as payment for the SMS rollout. The user creates himself/herself the template for these SMS’s 
                and bears full responsibility for their context, which in turn must correspond to the rules set by the Service’s 
                Anti-Spam Policy. Otherwise, the Service has the right to suspend the user’s account until it has ascertained the circumstances. 
            </p>
            <p class="text-gray-500 mb-4">
                An SMS created by the user is scheduled for sending through the Service. The time when SMS’s are delivered to their 
                recipients varies depending on several factors and circumstances. Spread shall not be liable for SMS’s being 
                undelivered to recipients, in equal measure, as well as any delays in delivery.
            </p>
            <p class="text-gray-500 mb-4">
                Messages may go undelivered or be delayed for the following reasons:
            </p>
            <ul class="list-disc list-inside mb-4 space-y-2 ml-6">
                <li class="text-gray-500">the subscriber’s mobile phone is turned off </li>
                <li class="text-gray-500">the subscriber is outside the area of their mobile operator’s coverage</li>
                <li class="text-gray-500">the subscriber’s mobile operator is having technical difficulties</li>
                <li class="text-gray-500">the subscriber’s inbox is full</li>
                <li class="text-gray-500">adverse natural conditions or other force majeure circumstances, which might have an 
                    adverse effect on the operation of Spread’s hardware and software. These conditions or circumstances include, 
                    but are not limited to, natural disasters, changes to law or regulations, embargoes, war, terrorist acts, riots, 
                    fires, earthquakes, nuclear accidents, floods, strikes, power blackouts, volcanic action, unusually severe weather 
                    conditions, and acts of hackers or third-party internet service providers.
                </li>
            </ul>
        </div>
        <!---Recipient Lists---->
        <div>
            <div class="text-gray-700 text-2xl font-medium">5. Recipient Lists</div>
            <p class="text-gray-500 mb-4">A user of the Spread service has the right to send SMS’s only to such people who have 
                expressed their consent to receiving communications from him/her. The recipients’ consent must be received by the 
                user personally. Upon the request of the Service administration, the user must provide corresponding proof of recipients’ consent.
            </p>
            <p class="text-gray-500 mb-4">
                After uploading a file, its contents are scanned to detect properly formatted and valid phone numbers and to also 
                assert the number of the phone numbers included in it for billing purposes. It is the user’s responsibility to 
                verify this information and make necessary changes to the data in case of an information mismatch. Spread doesn’t 
                guarantee the complete accuracy of the information displayed regarding the number of recipients in an uploaded file 
                and shall not bear any extra costs or issue any refunds in the event the user neglects to verify that information.
            </p>
            <p class="text-gray-500 mb-4">
                The user shall guarantee recipients the ability to opt out of any further communications and shall also be obliged 
                remove from the list of numbers, those who have expressed their desire to opt out of receiving SMS’s.
            </p>
            <p class="text-gray-500 mb-4">
                Use of illegally obtained subscriber bases and distributing spam through the Spread service is strictly prohibited.
            </p>
        </div>
        <!---Purchases---->
        <div>
            <div class="text-gray-700 text-2xl font-medium">6. Purchases, Payments and Refunds</div>
            <p class="text-gray-500 mb-4">
                The Spread | Bulk SMS Service works on a pay what for you use basis and does not offer membership plans. This means 
                the user has to pay for the number of SMS’s they intend to send and nothing more. The user can purchase any number 
                of SMS units which, if unused will remain in their account indefinitely until they use them, request a refund, or 
                decide to close their account.
            </p>
            <p class="text-gray-500 mb-4">
                The payment procedure will be as follows:
            </p>
            <ul class="list-disc list-inside mb-4 space-y-2 ml-6">
                <li class="text-gray-500">
                    The user makes his/her order on the official website of Spread in his/her account on the Service (Dashboard) or 
                    via communication means like email or telephone.
                </li>
                <li class="text-gray-500">
                    The administration of the Service will send the user a bill for payment. In the event that the user does not pay 
                    the bill within the designated period, it may be canceled.
                </li>
                <li class="text-gray-500">
                    Payment must be made solely through one of the means specified by the Spread service (Visa or MasterCard credit/debit 
                    cards, invoice for legal persons or bank transfer for natural persons).
                </li>
                <li class="text-gray-500">
                    After payment, the funds will appear on the user’s account within 30 minutes (for electronic payments) or within 3 
                    working days in the case of an invoice for legal persons or bank transfer for natural persons.
                </li>
                <li class="text-gray-500">
                    Within 30 (thirty) days from the moment that you pay for the service, you have the right to request that Spread 
                    refund any remaining funds that have not been spent for use of the service in the given period. When making such 
                    a request, you must provide a valid reason for a refund of these funds. When processing refund requests, the Spread 
                    service follows its <a class="text-accent-800 hover:text-accent-500" href="/refunds">Refund Policy</a>.
                </li>
            </ul>
        </div>
        <!---User's Obligations---->
        <div>
            <div class="text-gray-700 text-2xl font-medium">7. The User’s Obligations</div>
            <p class="text-gray-500 mb-4">The user is obliged:</p>
            <ul class="list-disc list-inside mb-4 space-y-2 ml-6">
                <li class="text-gray-500">
                    to ensure the confidentiality of his/her username and password for accessing his/her account on the Service, 
                    and to not allow third parties to use his/her account.
                </li>
                <li class="text-gray-500">to provide valid personal data to the Service.</li>
                <li class="text-gray-500">
                    to bear responsibility for the validity of all information which he/she uploads to his/her account on the Service.
                </li>
                <li class="text-gray-500">to not use a purchased or illegally obtained subscriber base for SMS’s.</li>
                <li class="text-gray-500">to not use the Service’s online platform for sending spam.</li>
                <li class="text-gray-500">
                    to create SMS’s in accordance with the terms of the Anti-Spam Policy and the Terms of Service of Spread. Should 
                    the user violate the Terms of Service or other requirements of the Service, the administration has the right to 
                    suspend or completely delete the user’s account until the incident has been resolved.
                </li>
                <li class="text-gray-500">to provide recipients with the ability to opt out of receiving SMS’s at any time.</li>
                <li class="text-gray-500">to refrain from rude and obscene speech when communicating with employees of the Service.</li>
            </ul>
            <p class="text-gray-500 mb-4">
                The user has the right to not agree with the Terms for using the Service. In that case, the user will be denied further use of Spread.
            </p>
            <p class="text-gray-500 mb-4">
                You represent and warrant that you either own or have permission to use all of the material in your SMS’s. You 
                retain ownership of the materials that you upload to the Service.
            </p>
            <p class="text-gray-500 mb-4">
                We may use or disclose your information only as described in these Terms and our Privacy Policy.
            </p>
            <p class="text-gray-500 mb-4">
                You represent and warrant that your use of the Service will comply with all applicable laws and regulations. You 
                are responsible for determining whether our services are suitable for you to use in light of any regulations. You 
                may not use our Service for any unlawful or discriminatory activities.
            </p>
            <p class="text-gray-500 mb-4">
                You represent and warrant that in creating your Recipient lists, sending SMS’s via the Service, and collecting 
                information as a result of sending SMS’s, you:
            </p>
            <ul class="list-disc list-inside mb-4 space-y-2 ml-6">
                <li class="text-gray-500">
                    will clearly describe in writing how you plan to use any data collected, including for your use of the Service. 
                    You will get express consent to transfer data to Spread as part of this process, and you will otherwise comply 
                    with whatever privacy policy you have posted.
                </li>
                <li class="text-gray-500">
                    have complied, and will comply, with all regulations, as well as data protection, electronic communication, and 
                    privacy laws that apply to the countries where you are sending any form of communication through the Service.
                </li>
                <li class="text-gray-500">
                    have collected, stored, used, and transferred all data relating to any individual in compliance with all data 
                    protection laws and regulations. You have the necessary permission to allow us to receive and process data and 
                    send communications to that individual on your behalf.
                </li>
                <li class="text-gray-500">
                    agree to indemnify and hold us harmless from any losses, including attorney fees, that result from your breach 
                    of any part of these warranties.
                </li>
            </ul>
        </div>
        <!---Spread Obligations---->
        <div>
            <div class="text-gray-700 text-2xl font-medium">8. Obligations of Spread</div>
            <p class="text-gray-500 mb-4">Spread is obliged to:</p>
            <ul class="list-disc list-inside mb-4 space-y-2 ml-6">
                <li class="text-gray-500">
                    provide the user, in accordance with the Terms of Service, with access to the online platform immediately after 
                    the user has registered for the Service.
                </li>
                <li class="text-gray-500">
                    provide the user with necessary functionality for creating and sending out  SMS.
                </li>
                <li class="text-gray-500">
                    ensure constant access to the online platform with the username and password that the user has chosen.
                </li>
                <li class="text-gray-500">
                    provide the possibility of testing the Service before payment for services.
                </li>
                <li class="text-gray-500">
                    present a billing/pricing plan without limiting the user in his/her choice of a purchase plan.
                </li>
                <li class="text-gray-500">
                    notify users of changes in billing plans and service pricing.
                </li>
            </ul>
            <p class="text-gray-500 mb-4">
                The administration reserves the right to make changes to the interface and functionality of the Spread online 
                platform and billing plans, and it shall notify the user of this in an email.
            </p>
            <p class="text-gray-500 mb-4">
                The administration reserves the right to unilaterally amend the Terms of Service for the Spread service without 
                prior notice to the user. The updated Terms of Service for the Spread service shall come into force from the moment 
                they are placed on the official website.
            </p>
        </div>
        <!---Restrictions---->
        <div>
            <div class="text-gray-700 text-2xl font-medium">9. Restrictions</div>
            <p class="text-gray-500 mb-4">
                The administration of Spread has the right to forbid (or limit) the user from any actions contrary to the Service’s 
                Terms of Service. These actions may include any listed below, as well as actions which, in the opinion of Service 
                employees, violate the Terms of Service for the Spread service.
            </p>
            <ul class="list-disc list-inside mb-4 space-y-2 ml-6">
                <li class="text-gray-500">
                    The user is forbidden from uploading to his/her account and from using any lists of telephone numbers that have 
                    been purchased or illegally obtained (including through the use of specialized programs for searching for contact information).
                </li>
                <li class="text-gray-500">
                    The user is forbidden to store, process, or disseminate using Spread any information contrary to the Anti-Spam 
                    Policy of the Service or which violates the laws of the Republic of Botswana or the laws of the country of the recipient.
                </li>
                <li class="text-gray-500">
                    The administration of the Service prohibits and shall punish any attempts by a user to collect information from the 
                    Service or from the company’s official website.
                </li>
                <li class="text-gray-500">
                    The user is forbidden from copying or using for commercial purposes any part of the Service or access to it.
                </li>
                <li class="text-gray-500">
                    The user does not have the right to provide a third party with his/her account access credentials, nor to 
                    register under the name of another person without his/her knowledge and consent.
                </li>
                <li class="text-gray-500">
                    The user is not allowed to use any means, including fraudulent or illegal means, for attempting to obtain 
                    the personal information of other Spread customers.
                </li>
                <li class="text-gray-500">
                    The user is forbidden from sending SMS’s to any recipients which have not given their consent to receive 
                    such SMS’s. The user is also forbidden from sending out any information which violates a person’s rights and freedoms.
                </li>
            </ul>
        </div>
        <!---Disclaimer of warranties---->
        <div>
            <div class="text-gray-700 text-2xl font-medium">10. Disclaimer of Warranties and Liability</div>
            <p class="text-gray-500 mb-4">
                The administration of the Service bears no responsibility for the user’s actions taken as a result of a failure to 
                understand or a mistaken understanding of the Terms of Service for the Spread service.
            </p>
            <p class="text-gray-500 mb-4">
                To the maximum extent permitted by law, you assume full responsibility for any loss that results from your use of 
                the Service, including any downloads from the Service. We won’t be liable for any indirect, punitive, special, or 
                consequential damages under any circumstances, even if they are based on negligence or we have been advised of the 
                possibility of those damages. Our total liability for all claims made about the service in any month will be no more 
                than what you paid us for the Service the month before.
            </p>
            <p class="text-gray-500 mb-4">
                To the maximum extent permitted by law, we provide the materials and the Service as is. That means we don’t provide 
                warranties of any kind, either express or implied, including but not limited to warranties of merchantability and 
                fitness for a particular purpose. Since our customers use Spread for a variety of reasons, we can’t guarantee that 
                it will meet your specific needs.
            </p>
            <p class="text-gray-500 mb-4">
                The Spread service does not guarantee to recipients of SMS's, sent out through its Service, the accuracy of the 
                information they receive. The Service only provides tools and services for carrying out bulk SMS sending. The 
                responsibility for the legality and accuracy of any information that the user sends through the Service is borne by 
                the user. The administration of the Service has the right to call the user to account for his/her actions if it 
                believes that they are contrary to the Spread Terms of Service.
            </p>
        </div>
        <!---Anti-Spam---->
        <div>
            <div class="text-gray-700 text-2xl font-medium">11. Anti-Spam Policy</div>
            <div class="pl-8 space-y-12">
                <div>
                    <div class="text-gray-700 text-2xl font-medium">11.1. General Conditions</div>
                    <p class="text-gray-500 mb-4">
                        We believe bulk SMS is a compelling tool for sending useful and on-demand information and are opposed to the 
                        sending of unsolicited messages.
                    </p>
                    <p class="text-gray-500 mb-4">
                        Any registered user of Spread can send SMS's to his/her friends, family, colleagues, clients, contacts etc. 
                        using our Service.
                    </p>
                    <p class="text-gray-500 mb-4">Spread strictly forbids any SPAM messages to be sent from our Service at any time.</p>
                </div>
                <div>
                    <div class="text-gray-700 text-2xl font-medium">11.2. Our Definition of Spam</div>
                    <p class="text-gray-500 mb-4">We consider any unsolicited, unexpected, or unwanted SMS text message sent to the 
                        mobile subscriber in order to extort their valuables from them or to mislead them, or any message originating 
                        from someone you have not authorized to have your mobile number to be SPAM.
                    </p>
                    <p class="text-gray-500 mb-4">
                        Our users specifically agree NOT to use Spread Service to send SPAM. Their SMS messages must comply with 
                        the following principles:
                    </p>
                    <ul class="list-disc list-inside mb-4 space-y-2 ml-6">
                        <li class="text-gray-500">
                            No false, invalid or misleading information in the body of SMS message should be sent using Spread.
                        </li>
                        <li class="text-gray-500">
                            No SMS must be sent to mobile subscribers without having previously obtained her/his consent.
                        </li>
                        <li class="text-gray-500">Text displayed must clearly state or illustrate the service that is offered.</li>
                        <li class="text-gray-500">
                            Marketing campaigns must clearly identify who is providing the service (originator) and clearly state the expense of the service promoted.
                        </li>
                    </ul>
                    <p class="text-gray-500 mb-4">
                        It is strictly forbidden to send messages to illegally collected recipient lists via the Spread Bulk SMS service.
                    </p>
                </div>
                <div>
                    <div class="text-gray-700 text-2xl font-medium">11.3. Our Definition of Illegally Collected Recipient Lists</div>
                    <p class="text-gray-500 mb-4">
                        A recipient list is legit if the recipient agreed to receive email messages from you.
                    </p>
                    <p class="text-gray-500 mb-4">The illegal ways of collecting recipient lists are:</p>
                    <ul class="list-disc list-inside mb-4 space-y-2 ml-6">
                        <li class="text-gray-500">Renting/buying phone numbers from a third party.</li>
                        <li class="text-gray-500">Collecting phone numbers from Yellow Pages, online directories, etc.</li>
                        <li class="text-gray-500">Getting phone numbers with the help of information extraction software.</li>
                        <li class="text-gray-500">Collecting phone numbers from business cards and questionnaires.</li>
                        <li class="text-gray-500">Collecting numbers during phone calls with customers.</li>
                    </ul>
                    <p class="text-gray-500 mb-4">
                        We reserve the right to request the mechanism a user uses to subscribe contacts to their recipient list.
                    </p>
                </div>
                <div>
                    <div class="text-gray-700 text-2xl font-medium">11.4. Prohibited Content</div>
                    <p class="text-gray-500 mb-4">Our Service doesn’t allow spam or any sort of offensive or illegal content.</p>
                    <p class="text-gray-500 mb-4">We do not send:</p>
                    <ul class="list-disc list-inside mb-4 space-y-2 ml-6">
                        <li class="text-gray-500">SMS rollouts that violate Data Protection Act, CAN-SPAM Act and other relevant legislation on SPAM.</li>
                        <li class="text-gray-500">Sexually explicit messages.</li>
                        <li class="text-gray-500">Hate speech</li>
                        <li class="text-gray-500">Marketing campaigns to a list of people without their permission.</li>
                    </ul>
                    <p class="text-gray-500 mb-4">
                        We review each profile to make sure it meets our Terms of Service, which help us maintain deliverability 
                        for all of our clients.
                    </p>
                    <p class="text-gray-500 mb-4">
                        Please understand that some industries or “niches” return more abuse and spam complaints than average. We 
                        cannot risk our service’s reputation, which affects each recipient lists profile.
                    </p>
                    <p class="text-gray-500 mb-4">
                        Our Service does not accept rollouts that offer types of services, products, or content listed below:
                    </p>
                    <ul class="list-disc list-inside mb-4 space-y-2 ml-6">
                        <li class="text-gray-500">Escort and dating services</li>
                        <li class="text-gray-500">Online and direct pharmaceutical sales, including but not limited to health and 
                            sexual well-being products, prescription, and counterfeit drugs
                        </li>
                        <li class="text-gray-500">
                            Work from home, make money online, and lead generation opportunities 
                            (“get rich quick”, “build your wealth”, “financial independence”)
                        </li>
                        <li class="text-gray-500">
                            Online trading, day trading tips, or stock market-related content including but not limited to stock 
                            message boards promotion
                        </li>
                        <li class="text-gray-500">
                            Pyramid schemes or multi-level channel, network and/or referral marketing (MLM) businesses used for 
                            prospecting or recruiting
                        </li>
                        <li class="text-gray-500">Affiliate marketing</li>
                        <li class="text-gray-500">Debt collections, credit repair and debt relief offerings</li>
                        <li class="text-gray-500">Mortgages and loans</li>
                        <li class="text-gray-500">Nutritional, herbal, and vitamin supplements</li>
                        <li class="text-gray-500">Adult novelty items or references</li>
                        <li class="text-gray-500">List brokers or list rental services</li>
                        <li class="text-gray-500">Illegal goods, pirated software, or media</li>
                        <li class="text-gray-500">Odds making and betting/gambling services, including but not limited to online 
                            poker, casino games, leisure, and pro sporting events.
                        </li>
                        <li class="text-gray-500">Political parties and organizations</li>
                        <li class="text-gray-500">Tobacco products</li>
                        <li class="text-gray-500">Alcohol products</li>
                        <li class="text-gray-500">Any religious content</li>
                    </ul>
                    <p class="text-gray-500 mb-4">
                        Note that the content of your SMS should be clearly associated with your sender name and your organization 
                        if and when applicable.
                    </p>
                </div>
                <div>
                    <div class="text-gray-700 text-2xl font-medium">11.5. Anti-Spam Enforcement</div>
                    <p class="text-gray-500 mb-4">
                        Any evidence of users not adhering to this Anti-Spam Policy will cause immediate disconnection of his/her 
                        spam messages sending, suspension of the Service and might also result in freezing of all money to ensure 
                        an immediate end to the violation until the details are cleared up.
                    </p>
                </div>
                <div>
                    <div class="text-gray-700 text-2xl font-medium">11.6. Your Right to Cancel/Money back Guarantee</div>
                    <ul class="list-disc list-inside mb-4 space-y-2 ml-6">
                        <li class="text-gray-500">
                            You can cancel account purchases when testing/trying out the Spread Service only until you have sent 
                            50 SMS messages, otherwise, the user account is considered to be fully working, and no refund will be allowable.
                        </li>
                        <li class="text-gray-500">
                            If your account is cancelled or suspended due to SPAM complaints, no refund will be allowable. See details 
                            in our <a class="text-accent-800 hover:text-accent-500" href="/refunds">Refund Policy</a>.
                        </li>
                        <li class="text-gray-500">
                            Make sure all recipients are permission-based recipients, i.e., agreed to receive messages from you.
                        </li>
                        <li class="text-gray-500">
                            We reserve the right to stop providing service and block user account if even one of your SMS rollouts 
                            gets over-the-top complaints.
                        </li>
                        <li class="text-gray-500">
                            Accounts blocked due to exceeding complaints are denied in getting a refund.
                        </li>
                    </ul>
                    <p class="text-gray-500 mb-4">
                        We understand that there can be a certain number of complaints if you send bulk SMS messages. According to 
                        our Service terms and conditions, we specified the level of a permitted complaints as no more than 5% per 
                        recipient list for a single SMS rollout. In addition, we take into consideration different factors like the 
                        amount of sent SMS’s as well as complaints ratio and types of complaints. If your SMS rollout gets a ratio 
                        that exceeds the permitted level, we reserve the right to block or terminate your account without a refund.
                    </p>
                </div>
                <div>
                    <div class="text-gray-700 text-2xl font-medium">11.7. SPAM and Abuse Reporting</div>
                    <p class="text-gray-500 mb-4">
                        Please let us know about any abuse or unwanted/unsolicited messages. In your email, please include the 
                        spam-SMS, the date and time you received the message. Send your report to 
                        <a class="text-accent-800 hover:text-accent-500" href="mailto:support@spread.co.bw">support@spread.co.bw</a>.
                    </p>
                    <p class="text-gray-500 mb-4">
                        User accounts that receive spam complaints will be suspended until the case is clarified.
                    </p>
                </div>
            </div>
            <p class="text-gray-500 mb-4"></p>
        </div>
        <!---Governing Law---->
        <div>
            <div class="text-gray-700 text-2xl font-medium">12. Governing Law and Dispute Resolution</div>
            <p class="text-gray-500 mb-4">
                The relationship between the company and the user with regard to provision of services for Spread, is governed by 
                the laws of the Republic of Botswana without regard to the conflicts of laws provisions thereof.
            </p>
            <p class="text-gray-500 mb-4">
                Any dispute arising from or relating to the subject matter of these Terms, which cannot be settled by the parties 
                within 30 (thirty) days thereafter shall be finally settled by the court (High Court) in Gaborone, Botswana, and 
                each party will be subject to the jurisdiction of the court.
            </p>
        </div>
        <div class="text-gray-700 font-medium mb-24">Created: 29-11-21</div>
    </div>
    @include('components.footer')
</section>
@endsection

