@extends('layouts.frontend.app')

@section('title','Home')

@push('css')
    <link href="{{ asset('assets/frontend/css/home/styles.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    {{-- <link href="{{ asset('assets/frontend/css/home/responsive.css') }}" rel="stylesheet"> --}}
    <style>
        .favorite_posts{
            color: blue;
        }
    </style>
@endpush

@section('content')
 

        <!-- hero seaction  -->
    <div class="hero_section">

        <div class="hero_content">

            <div class="hero_title">
                <h1>🚀 Welcome to <span>Assignment Art</span> - Your Academic Success Partner! 🎓</h1>

                    <h2>Embark on a journey of excellence with our expert assignment help. We don't just meet expectations; we exceed them.</h2>
            </div>

            <div class="hero_btn">

                <a ><button id="showTawkTo">Live Chat</button></a>
                <a href="https://api.whatsapp.com/send?phone=923356282834" target="_blank"><button>WhatsApp</button></a>
            </div>
        </div>

    </div>


    <!-- Place order section  -->

    <div class="order_section" id="order">
        <div class="order_head">
            <h1>Order-now</h1>
        </div>

        <form action="{{ route('order-submit') }}" method="POST" enctype="multipart/form-data" >
            @csrf
        <div class="order_form">
            
                
                <div class="form-first">
                <span>
                    <label for="text">Paper Topic:</label>
                    <input type="text" name="topic" placeholder="Write Your Topic">
                </span>

                <span>
                    <label for="deadline">Deadline*</label>
                    <select name="dead_line_id" id="deadline" >
                        <option value="deadline" class="active_one">Deadline</option>
                          
                                        @foreach($deadlines as $deadline)
                                            <option value="{{ $deadline->id }}">{{ $deadline->name }}</option>
                                        @endforeach
                               
                       
                    </select>
                </span>

                <span>
                    <label for="wordslist">No of Words:</label>
                    <select name="no_words" id="wordslist" >
                        <option value="No of Words" class="active_one">Please Select Words Count</option>
                        
                        @foreach($nowords as $noword)
                        <option value="{{ $noword->id }}">{{ $noword->name }}</option>
                    @endforeach

                    </select>
                </span>

                <span>
                    <label for="reference">References:</label>
                    <select name="no_of_reference" id="reference">
                        <option value="reference" class="active_one">Select No. of Reference
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                    </select>
                </span>
            </div>
                <div class="form-first">
                    <span>
                        <label for="papertype">Paper Type:</label>
                        <select name="paper_type_id" id="papertype" >
                            <option  class="active_one">Paper Type
                          
                                @foreach($papertypes as $papertype)
                                <option value="{{ $papertype->id }}">{{ $papertype->name }}</option>
                            @endforeach
                        </select>
                    </span>
    
                    <span>
                        <label for="subject">Subjects*</label>
                        <select name="subject_id" id="subject">
                            <option class="active_one">Subjects
                           
                                @foreach($subjects as $subject)
                                <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                            @endforeach
                        </select>
                    </span>
    
                    <span>
                        <label for="education">Education Level*</label>
                        <select name="education_level_id" id="education">
                            <option  class="active_one">Choose Your Academic Level</option>
                       
                            @foreach($educationlevels as $educationlevel)
                            <option value="{{ $educationlevel->id }}">{{ $educationlevel->name }}</option>
                        @endforeach
                        </select>
                    </span>
    
                    <span>
                        <label for="referencestyle">Reference Style*</label>
                        <select name="reference_style_id" id="referencestyle">
                            <option  class="active_one">Select Reference Style</option>
                           
                            @foreach($referencestyles as $referencestyle)
                            <option value="{{ $referencestyle->id }}">{{ $referencestyle->name }}</option>
                        @endforeach
                        </select>
                    </span>
    
                    
                   
    
                </div>
                

                
                
                
                
                
            </div>
            <div class="order_detail">
                <label for="textarea">Details:</label>
                <textarea name="detail" id="textarea" placeholder="Type details here..."></textarea>
            </div>
            <div class="attach_file">

                <span>
                    <h4>Attach File
                        <small>(max file attach : 1 or make zip file | max file size : 25Mb)</small>
                    </h4>
                   
                </span>
    
    
                    <label for="myfile"></label>
                    <input type="file" id="myfile" name="myfile" >
              
    
            </div>
            <div class="personal_info">
                <div class="header">
                    <h1>Personal Details</h1>
                </div>
                <div class="content">
                    <div class="my_detail">
                        <span>
                                <label for="name">Your Name:</label>
                                <input type="text" name="user_name" id="name" placeholder="Full Name">
                        </span>
        
                        <span>
                            <label for="Country:">Country:</label>
                            <select name="country" id="Country:">
                                <option value="" class="active_one">Select Country</option>
                                <option   value="Afghanistan">Afghanistan</option>    
                                <option   value="Albania">Albania</option>    
                                <option   value="Algeria">Algeria</option>    
                                <option   value="American Samoa">American Samoa</option>    
                                <option   value="Andorra">Andorra</option>    
                                <option   value="Angola">Angola</option>    
                                <option   value="Anguilla">Anguilla</option>    
                                <option   value="Antarctica">Antarctica</option>    
                                <option   value="Antigua and/or Barbuda">Antigua and/or Barbuda</option>    
                                <option   value="Argentina">Argentina</option>    
                                <option   value="Armenia">Armenia</option>    
                                <option   value="Aruba">Aruba</option>    
                                <option   value="Australia">Australia</option>    
                                <option   value="Austria">Austria</option>    
                                <option   value="Azerbaijan">Azerbaijan</option>    
                                <option   value="Bahamas">Bahamas</option>    
                                <option   value="Bahrain">Bahrain</option>    
                                <option   value="Bangladesh">Bangladesh</option>    
                                <option   value="Barbados">Barbados</option>    
                                <option   value="Belarus">Belarus</option>    
                                <option   value="Belgium">Belgium</option>    
                                <option   value="Belize">Belize</option>    
                                <option   value="Benin">Benin</option>    
                                <option   value="Bermuda">Bermuda</option>    
                                <option   value="Bhutan">Bhutan</option>    
                                <option   value="Bolivia">Bolivia</option>    
                                <option   value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>    
                                <option   value="Botswana">Botswana</option>    
                                <option   value="Bouvet Island">Bouvet Island</option>    
                                <option   value="Brazil">Brazil</option>    
                                <option   value="British lndian Ocean Territory">British lndian Ocean Territory</option>    
                                <option   value="Brunei Darussalam">Brunei Darussalam</option>    
                                <option   value="Bulgaria">Bulgaria</option>    
                                <option   value="Burkina Faso">Burkina Faso</option>    
                                <option   value="Burundi">Burundi</option>    
                                <option   value="Canada">Canada</option>    
                                <option   value="Cambodia">Cambodia</option>    
                                <option   value="Cameroon">Cameroon</option>    
                                <option   value="Cape Verde">Cape Verde</option>    
                                <option   value="Cayman Islands">Cayman Islands</option>    
                                <option   value="Central African Republic">Central African Republic</option>    
                                <option   value="Chad">Chad</option>    
                                <option   value="Chile">Chile</option>    
                                <option   value="China">China</option>    
                                <option   value="Christmas Island">Christmas Island</option>    
                                <option   value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>    
                                <option   value="Colombia">Colombia</option>    
                                <option   value="Comoros">Comoros</option>    
                                <option   value="Congo">Congo</option>    
                                <option   value="Cook Islands">Cook Islands</option>    
                                <option   value="Costa Rica">Costa Rica</option>    
                                <option   value="Croatia (Hrvatska)">Croatia (Hrvatska)</option>    
                                <option   value="Cuba">Cuba</option>    
                                <option   value="Cyprus">Cyprus</option>    
                                <option   value="Czech Republic">Czech Republic</option>    
                                <option   value="Democratic Republic of Congo">Democratic Republic of Congo</option>    
                                <option   value="Denmark">Denmark</option>    
                                <option   value="Djibouti">Djibouti</option>    
                                <option   value="Dominica">Dominica</option>    
                                <option   value="Dominican Republic">Dominican Republic</option>    
                                <option   value="East Timor">East Timor</option>    
                                <option   value="Ecudaor">Ecudaor</option>    
                                <option   value="Egypt">Egypt</option>    
                                <option   value="El Salvador">El Salvador</option>    
                                <option   value="Equatorial Guinea">Equatorial Guinea</option>    
                                <option   value="Eritrea">Eritrea</option>    
                                <option   value="Estonia">Estonia</option>    
                                <option   value="Ethiopia">Ethiopia</option>    
                                <option   value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>    
                                <option   value="Faroe Islands">Faroe Islands</option>    
                                <option   value="Fiji">Fiji</option>    
                                <option   value="Finland">Finland</option>    
                                <option   value="France">France</option>    
                                <option   value="France, Metropolitan">France, Metropolitan</option>    
                                <option   value="French Guiana">French Guiana</option>    
                                <option   value="French Polynesia">French Polynesia</option>    
                                <option   value="French Southern Territories">French Southern Territories</option>    
                                <option   value="Gabon">Gabon</option>    
                                <option   value="Gambia">Gambia</option>    
                                <option   value="Georgia">Georgia</option>    
                                <option   value="Germany">Germany</option>    
                                <option   value="Ghana">Ghana</option>    
                                <option   value="Gibraltar">Gibraltar</option>    
                                <option   value="Greece">Greece</option>    
                                <option   value="Greenland">Greenland</option>    
                                <option   value="Grenada">Grenada</option>    
                                <option   value="Guadeloupe">Guadeloupe</option>    
                                <option   value="Guam">Guam</option>    
                                <option   value="Guatemala">Guatemala</option>    
                                <option   value="Guinea">Guinea</option>    
                                <option   value="Guinea-Bissau">Guinea-Bissau</option>    
                                <option   value="Guyana">Guyana</option>    
                                <option   value="Haiti">Haiti</option>    
                                <option   value="Heard and Mc Donald Islands">Heard and Mc Donald Islands</option>    
                                <option   value="Honduras">Honduras</option>    
                                <option   value="Hong Kong">Hong Kong</option>    
                                <option   value="Hungary">Hungary</option>    
                                <option   value="Iceland">Iceland</option>    
                                <option   value="India">India</option>    
                                <option   value="Indonesia">Indonesia</option>    
                                <option   value="Iran (Islamic Republic of)">Iran (Islamic Republic of)</option>    
                                <option   value="Iraq">Iraq</option>    
                                <option   value="Ireland">Ireland</option>    
                                <option   value="Israel">Israel</option>    
                                <option   value="Italy">Italy</option>    
                                <option   value="Ivory Coast">Ivory Coast</option>    
                                <option   value="Jamaica">Jamaica</option>    
                                <option   value="Japan">Japan</option>    
                                <option   value="Jordan">Jordan</option>    
                                <option   value="Kazakhstan">Kazakhstan</option>    
                                <option   value="Kenya">Kenya</option>    
                                <option   value="Kiribati">Kiribati</option>    
                                <option   value="Korea, Democratic People&#039;s Republic of">Korea, Democratic People&#039;s Republic of</option>    
                                <option   value="Korea, Republic of">Korea, Republic of</option>    
                                <option   value="Kuwait">Kuwait</option>    
                                <option   value="Kyrgyzstan">Kyrgyzstan</option>    
                                <option   value="Lao People&#039;s Democratic Republic">Lao People&#039;s Democratic Republic</option>    
                                <option   value="Latvia">Latvia</option>    
                                <option   value="Lebanon">Lebanon</option>    
                                <option   value="Lesotho">Lesotho</option>    
                                <option   value="Liberia">Liberia</option>    
                                <option   value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>    
                                <option   value="Liechtenstein">Liechtenstein</option>    
                                <option   value="Lithuania">Lithuania</option>    
                                <option   value="Luxembourg">Luxembourg</option>    
                                <option   value="Macau">Macau</option>    
                                <option   value="Macedonia">Macedonia</option>    
                                <option   value="Madagascar">Madagascar</option>    
                                <option   value="Malawi">Malawi</option>    
                                <option   value="Malaysia">Malaysia</option>    
                                <option   value="Maldives">Maldives</option>    
                                <option   value="Mali">Mali</option>    
                                <option   value="Malta">Malta</option>    
                                <option   value="Marshall Islands">Marshall Islands</option>    
                                <option   value="Martinique">Martinique</option>    
                                <option   value="Mauritania">Mauritania</option>    
                                <option   value="Mauritius">Mauritius</option>    
                                <option   value="Mayotte">Mayotte</option>    
                                <option   value="Mexico">Mexico</option>    
                                <option   value="Micronesia, Federated States of">Micronesia, Federated States of</option>    
                                <option   value="Moldova, Republic of">Moldova, Republic of</option>    
                                <option   value="Monaco">Monaco</option>    
                                <option   value="Mongolia">Mongolia</option>    
                                <option   value="Montserrat">Montserrat</option>    
                                <option   value="Morocco">Morocco</option>    
                                <option   value="Mozambique">Mozambique</option>    
                                <option   value="Myanmar">Myanmar</option>    
                                <option   value="Namibia">Namibia</option>    
                                <option   value="Nauru">Nauru</option>    
                                <option   value="Nepal">Nepal</option>    
                                <option   value="Netherlands">Netherlands</option>    
                                <option   value="Netherlands Antilles">Netherlands Antilles</option>    
                                <option   value="New Caledonia">New Caledonia</option>    
                                <option   value="New Zealand">New Zealand</option>    
                                <option   value="Nicaragua">Nicaragua</option>    
                                <option   value="Niger">Niger</option>    
                                <option   value="Nigeria">Nigeria</option>    
                                <option   value="Niue">Niue</option>    
                                <option   value="Norfork Island">Norfork Island</option>    
                                <option   value="Northern Mariana Islands">Northern Mariana Islands</option>    
                                <option   value="Norway">Norway</option>    
                                <option   value="Oman">Oman</option>    
                                <option   value="Pakistan">Pakistan</option>    
                                <option   value="Palau">Palau</option>    
                                <option   value="Panama">Panama</option>    
                                <option   value="Papua New Guinea">Papua New Guinea</option>    
                                <option   value="Paraguay">Paraguay</option>    
                                <option   value="Peru">Peru</option>    
                                <option   value="Philippines">Philippines</option>    
                                <option   value="Pitcairn">Pitcairn</option>    
                                <option   value="Poland">Poland</option>    
                                <option   value="Portugal">Portugal</option>    
                                <option   value="Puerto Rico">Puerto Rico</option>    
                                <option   value="Qatar">Qatar</option>    
                                <option   value="Republic of South Sudan">Republic of South Sudan</option>    
                                <option   value="Reunion">Reunion</option>    
                                <option   value="Romania">Romania</option>    
                                <option   value="Russian Federation">Russian Federation</option>    
                                <option   value="Rwanda">Rwanda</option>    
                                <option   value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>    
                                <option   value="Saint Lucia">Saint Lucia</option>    
                                <option   value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>    
                                <option   value="Samoa">Samoa</option>    
                                <option   value="San Marino">San Marino</option>    
                                <option   value="Sao Tome and Principe">Sao Tome and Principe</option>    
                                <option   value="Saudi Arabia">Saudi Arabia</option>    
                                <option   value="Senegal">Senegal</option>    
                                <option   value="Serbia">Serbia</option>    
                                <option   value="Seychelles">Seychelles</option>    
                                <option   value="Sierra Leone">Sierra Leone</option>    
                                <option   value="Singapore">Singapore</option>    
                                <option   value="Slovakia">Slovakia</option>    
                                <option   value="Slovenia">Slovenia</option>    
                                <option   value="Solomon Islands">Solomon Islands</option>    
                                <option   value="Somalia">Somalia</option>    
                                <option   value="South Africa">South Africa</option>    
                                <option   value="South Georgia South Sandwich Islands">South Georgia South Sandwich Islands</option>    
                                <option   value="Spain">Spain</option>    
                                <option   value="Sri Lanka">Sri Lanka</option>    
                                <option   value="St. Helena">St. Helena</option>    
                                <option   value="St. Pierre and Miquelon">St. Pierre and Miquelon</option>    
                                <option   value="Sudan">Sudan</option>    
                                <option   value="Suriname">Suriname</option>    
                                <option   value="Svalbarn and Jan Mayen Islands">Svalbarn and Jan Mayen Islands</option>    
                                <option   value="Swaziland">Swaziland</option>    
                                <option   value="Sweden">Sweden</option>    
                                <option   value="Switzerland">Switzerland</option>    
                                <option   value="Syrian Arab Republic">Syrian Arab Republic</option>    
                                <option   value="Taiwan">Taiwan</option>    
                                <option   value="Tajikistan">Tajikistan</option>    
                                <option   value="Tanzania, United Republic of">Tanzania, United Republic of</option>    
                                <option   value="Thailand">Thailand</option>    
                                <option   value="Togo">Togo</option>    
                                <option   value="Tokelau">Tokelau</option>    
                                <option   value="Tonga">Tonga</option>    
                                <option   value="Trinidad and Tobago">Trinidad and Tobago</option>    
                                <option   value="Tunisia">Tunisia</option>    
                                <option   value="Turkey">Turkey</option>    
                                <option   value="Turkmenistan">Turkmenistan</option>    
                                <option   value="Turks and Caicos Islands">Turks and Caicos Islands</option>    
                                <option   value="Tuvalu">Tuvalu</option>    
                                <option   value="Uganda">Uganda</option>    
                                <option   value="Ukraine">Ukraine</option>    
                                <option   value="United Arab Emirates">United Arab Emirates</option>    
                                <option   value="United Kingdom">United Kingdom</option>    
                                <option   value="United States">United States</option>    
                                <option   value="United States minor outlying islands">United States minor outlying islands</option>    
                                <option   value="Uruguay">Uruguay</option>    
                                <option   value="Uzbekistan">Uzbekistan</option>    
                                <option   value="Vanuatu">Vanuatu</option>    
                                <option   value="Vatican City State">Vatican City State</option>    
                                <option   value="Venezuela">Venezuela</option>    
                                <option   value="Vietnam">Vietnam</option>    
                                <option   value="Virgin Islands (British)">Virgin Islands (British)</option>    
                                <option   value="Virgin Islands (U.S.)">Virgin Islands (U.S.)</option>    
                                <option   value="Wallis and Futuna Islands">Wallis and Futuna Islands</option>    
                                <option   value="Western Sahara">Western Sahara</option>    
                                <option   value="Yemen">Yemen</option>    
                                <option   value="Yugoslavia">Yugoslavia</option>    
                                <option   value="Zaire">Zaire</option>    
                                <option   value="Zambia">Zambia</option>    
                                <option   value="Zimbabwe">Zimbabwe</option>    
                            </select>
                        </span>
        
                    </div>
                    
                    <div class="my_detail">
                        <span>
                                <label for="email">Your Email:</label>
                                <input type="text" name="email" id="email" placeholder="Email">
                        </span>
        
                        <span>
                            <label for="text">Contact Number:</label>
                            <input type="text" name="mobile" id="text" placeholder="Phone">
                    </span>
        
                    </div>
        
                </div>
                <div class="submit_btn">
                    <button>Order Submit</button>
                </div>
        
            </div>
        </form>
            
   

       
        
       
    </div>

    <div class="card">
        <h1>Elevate Your Academic Journey</h1>
        <p>Navigating the challenges of student life can be overwhelming—juggling college assignments, striving for top-notch grades, and maintaining a vibrant social life. Falling behind isn't an option, as the competition is fierce.</p>
        <p>At Assignment Help Hub, we empower students to conquer the academic hustle by offering affordable and professional assignment services. Our seasoned writers specialize in crafting 100% unique assignments, unlocking doors to success with exceptional grades. In a sea of assignment websites, what sets us apart is our commitment to research-driven, high-quality papers delivered well before the deadline.</p>
        <p>Unlock your potential and soar to academic excellence with Assignment Help Hub!</p>
        <a href="#" class="cta-button">Explore Our Services</a>
    </div>
{{-- 
    <div class="our_services">
        <h1>Leading Assignment Writing Services in Pakistan to assist your Writing Needs Professionally!</h1>
        <p>The student life is filled with myriad challenges. At one time they have to be everywhere, either it’s about submitting the college assignments, achieving outstanding grades or managing their social lives. And if they stay below the curve, there are many chances that someone will outsmart them. The desire to stay perfect everytime drains their creativity and the capacity to churn out quality assignment papers.</p>
        <p>We at Assignment Help Pakistan, encourage students in overcoming the flow of academic work by providing them affordable assignment services in Pakistan. Our expert assignment writers know the art of creating 100% unique assignments that help students to excel in their career by achieving excellent grades. Although there are a great number of assignment making websites but what separates us from the rest is the research-driven and quality assignment papers that we deliver before the time.</p>

    </div> --}}

    <!-- writers section  -->

    {{-- <div class="our_writers">

        <div class="writer_head">
            <h1>Help from the Professional Assignment Writers in Pakistan, Plagiarism-Free Papers & Affordable Services</h1>
        </div>

        <div class="cards">

            <div class="card_single">
                <p>When students are searching online assignment help in Pakistan, 
                    they always look for three things that are Originality, Timeliness,
                     and Affordability. And we offer more than that! Our assignment services
                      have make a roar among the students because of the quality we serve. 
                      We have the best assignment makers in Pakistan who not only craft paper
                       according to the requirements but also add the X factor that produces excellent results
                       . We have a systematic approach to write your assignments, we brainstorm the topic, 
                       study your requirements, research about it and perfect it to your needs. No matter either 
                       you ask us for literature assignments, psychology, medical, management, report writing,
                        case studies or any other university assignment help, you’ll always find us staying ahead
                         of your requirements.
                        </p>
                    </div>

                    <div class="card_single">
                        <p>Plagiarism sounds deadliest; it can kill your assignments
                             faster than you can imagine. We have zero tolerance for
                              plagiarism filled content, and you’ll never find us
                               serving copied assignments. Our assignment makers
                                in Islamabad, Lahore, and Karachi hold Masters and PhD degrees,
                                 and they know how to model the papers being in the student’s shoes.
                                  Understanding the fact that students are tight on budgets 
                                  and don’t have enough finances to spend on freelance assignment help,
                                   we have keep our services affordable and in the range of students.
                                    With the help of our expert assignment writers, we provide assignments 
                                    that help students flourish in their career.
                                </p>
                            </div>

        </div>
        
    </div> --}}

    <!-- our Benefits section  -->
    <div class="our_benefits">
        <div class="benefits-container">
          <div class="benefit-card">
            <h3>- Student-Centric Approach:</h3>
            <p>Our mission is to elevate your academic journey. We focus on your success, ensuring that every assignment meets high standards. Our versatile team covers a wide range of subjects to meet your unique requirements.</p>
          </div>
    
          <div class="benefit-card">
            <h3>- Tailored Assignments, Every Time:</h3>
            <p>No generic templates here! Each assignment is custom-crafted to meet your specific requirements. Our dedicated assignment makers bring expertise in various niches, ensuring top-notch quality.</p>
          </div>
    
          <div class="benefit-card">
            <h3>- Responsive to Your Revision Needs:</h3>
            <p>You're the priority. We welcome revision requests because your satisfaction matters. Whether it's once, twice, or unlimited times, our customer support team goes the extra mile to exceed your expectations.</p>
          </div>
        </div>
      </div>
    {{-- <div class="our_benefits">
        <div class="head_menu">
            <h1>Benefits to hire our assignment writing help in Pakistan</h1>
            <p>Besides having the countless websites offering online assignments for students, here are the reasons why you should choose us.</p>
        </div>
        <div class="card_menu">

            <div class="just_card">
                <h3>- We are centered on you:</h3>
                <p>Our assignment services are not geared to uplift our name in the competition but instead raising your grades. We never submit the order that is below the criteria and haven’t been proofread by our quality assurance team. Having the versatility to serve a wide range of subjects, we are positive to cater your requirements perfectly.</p>
            </div>

            <div class="just_card">
                <h3>- Custom assignment help in Pakistan:</h3>
                <p>We don’t have a pre-built template that caters all the general assignment writing help in Pakistan. Each of our assignments is tailored to the requirements and are assigned to the best assignment makers in Pakistan whose skills match the required niche.</p>
            </div>

            <div class="just_card">
                <h3>- We stay prompt to the revision request:</h3>
                <p>We treat customers as King. Revision request is their right, so we gave the leverage to the customers by following their need for revisions even if they ask twice, thrice or unlimited times. Our customer support team go beyond the expectations to achieve customer’s satisfaction on a great note.</p>
            </div>

        </div>
    </div> --}}

    <!-- our hiring perks -->
    {{-- <div class="our_perks">
            <h1>Perks of Hiring Us</h1>

            <span>
                <p>✓ Research Driven Assignments</p>
                <p>✓ Qualified Assignment Writers</p>
                <p>✓ Unlimited Revisions</p>
                <p>✓ 100% Plagiarism Free</p>
                <p>✓ Timeliness</p>
                <p>✓ Money Back Guarantee</p>
                <p>✓ Formatted Papers</p>
                <p>✓ Excellent Customer Support</p>  
            </span>

            <div class="join_perk">
               <h2>
                <a href="">Connect Now</a>
                & Get The Best Assignment Help Online!
            </h2>
            </div>
    </div> --}}
    <div class="our_perks">
        <div class="perks-container">
          <h1>Perks of Hiring Us</h1>
    
          <span class="perks-list">
            <p>✨ Why Choose Us?</p>
            <p>📚 Unmatched Expertise: Our seasoned professionals cover a spectrum of subjects.</p>
            <p>🕒 On-Time Delivery: Because deadlines matter, and so does your time.</p>
            <p>🌟 Quality Assurance: Every assignment is a masterpiece crafted for success.</p>
            <p>💡 24/7 Support: Your questions, our priority—round-the-clock assistance.</p>
          </span>
    
          <div class="join_perk">
            <h2>
              {{-- <a href="#">Connect Now</a> --}}
              & Get The Best Assignment Help Online!
            </h2>
          </div>
        </div>
      </div>

 
@endsection

@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
{!! Toastr::message() !!}
@endpush