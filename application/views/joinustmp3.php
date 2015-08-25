<?php
load_view("Template/top.php");
load_view("Template/navbarnew.php");
//$message="";
?>
<?php if(!$issubmitted){?>
<main>
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="card-panel">
          <h4 class="teal-text text-darken-1 center">Edit profile</h4>
          <br>
          <div class="row">
            <div class="col-xs-12">
            <form class="col-xs-12 col-md-10 col-md-offset-1" enctype="multipart/form-data"  method="post" onsubmit="return submitForm_t2(this);">
              <div class="row">
              <div id="errorReport"></div>
                <div class="col-xs-12">
                  <div class="center grey-text text-darken-1"></div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-md-4">
                  <span class="grey-text text-darken-1">Name<span class="red-text">*</span></span>
                </div>
                 <?php
                   foreach($info as $key=>$val){
                   $str=$val['name'];
                   $array = explode(' ', $str);
                   $a=array();
                   foreach ($info_t as $key => $value){
                   $a=$value['jsoninfo'];
                   $b=str2json($a);
                ?>
                <div class="col-xs-12 col-md-4">
                  <input placeholder="First Name"   type="text" class="validate" name="fname"  data-condition="simple" length="35" value="<?php echo $array[0];?>">
                </div>
                <div class="col-xs-12 col-md-4">
                  <input placeholder="Last Name" type="text" class="validate" name="lname" data-condition="simple" length=35 value="<?php echo $array[1];?>">
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-md-4">
                  <span class="grey-text text-darken-1">Subjects<span class="red-text">*</span></span>
                  <br>
                  <span class="grey-text text-lighten-1" style="font-size: 13px;">You would love to teach</span>
                </div>
                <div class="col-xs-12 col-md-4">
                  <div>
                    <?php 
                       $temp2=explode('-',$b['sub']); ?>
                    <input id="math" type="checkbox" name="sub1" data-condition="checkbox" data-group="sub"
                     <?php if(in_array(1, $temp2)){?>  
                           checked="checked" <?php } ?>
                    >
                        
                    <label for="math">Mathematics</label>
                  </div>
                  <div>
                    <input id="physics" type="checkbox" name="sub2" data-condition="checkbox" data-group="sub" <?php if(in_array(2, $temp2)){?>  
                           checked="checked" <?php } ?>
                    >
                    <label for="physics">Physics</label>
                  </div>
                  <div>
                    <input id="chemistry" type="checkbox" name="sub3" data-condition="checkbox" data-group="sub" <?php if(in_array(3, $temp2)){?>  
                           checked="checked" <?php } ?>
                    >
                    <label for="chemistry">Chemistry</label>
                  </div>
                </div>
                <div class="col-xs-12 col-md-4">
                  <div>
                    <input id="biology" type="checkbox" name="sub4" data-condition="checkbox" data-group="sub" <?php if(in_array(4, $temp2)){?>  
                           checked="checked" <?php } ?>
                    >
                    <label for="biology">Biology</label>
                  </div>
                  <div>
                    <input id="science" type="checkbox" name="sub5" data-condition="checkbox" data-group="sub" <?php if(in_array(5, $temp2)){?>  
                           checked="checked" <?php } ?>
                    >
                    <label for="science">Science (6-10)</label>
                  </div>
                  <div>
                    <input id="subject_others" type="checkbox" name="sub6" data-condition="checkbox"  data-group="sub" onchange="ot();" <?php if(in_array('other', $temp2)){?>  
                                                  checked="checked" <?php } ?>
                    >
                    <label for="subject_others">Others</label>
                  </div>
                </div>
              </div>
              <div class="row" id="otherType1">
                <div class="col-xs-12 col-md-8 col-md-offset-4">

                  <input placeholder="Specify if Others" type="text" class="validate" name="subother" length=20 value="<?php if(in_array('other', $temp2)) echo $b['subother'];?>">
            
                </div>
              </div>
              <?php 
              $temp1=explode('-',$b['sub']); ?>
               
              <div class="row">
                <div class="col-xs-12 col-md-4">
                  <span class="grey-text text-darken-1">Grade<span class="red-text">*</span></span>
                  </div>
                <div class="col-xs-12 col-md-4">
                  <div>
                    <input id="6to8" type="checkbox" name="grade1" data-condition="checkbox" data-group="grade" <?php if(in_array(1, $temp1)){?> 
                                    checked="checked" <?php } 
                                     ?>>
                    <label for="6to8">6<sup>th</sup> to 8<sup>th</sup></label>
                  </div>
                  <div>
                    <input id="9to10" type="checkbox" name="grade2" data-condition="checkbox" data-group="grade" <?php if(in_array(2, $temp1)){?> 
                                    checked="checked" <?php } 
                                     ?>>
                    <label for="9to10">9<sup>th</sup> to 10<sup>th</sup></label>
                  </div>
                </div>
                <div class="col-xs-12 col-md-4">
                  <div>
                    <input id="11to12" type="checkbox" name="grade3" data-condition="checkbox" data-group="grade" <?php if(in_array(3, $temp1)){?> 
                                    checked="checked" <?php } 
                                     ?>>
                    <label for="11to12">11<sup>th</sup> to 12<sup>th</sup></label>
                  </div>
                  <div>
                    <input id="iitjee" type="checkbox" name="grade4" data-condition="checkbox" data-group="grade"  <?php if(in_array(4, $temp1)){?> 
                                    checked="checked" <?php } 
                                     ?>>
                    <label for="iitjee">IIT JEE</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-md-4">
                  <span class="grey-text text-darken-1">Mininum Fees<span class="red-text">*</span></span><br>
                    <span class="grey-text text-lighten-1" style="font-size: 13px;">Minimun tution fees per hour</span>
                </div>
                
                <div class="col-xs-12 col-md-4">
                  <select data-condition="simple"  class="browser-default" onchange="f(this);" name="minfees" id="minfees">
                    <option value="<?php echo $b['minfees']; ?>" selected><?php echo 'Rs.'.$b['minfees']; ?></option>
                    <!-- <option value="" disabled selected>Min.Fees</option> -->
                    <option value="200">Rs.200</option>
					<option value="300">Rs.300</option>
                    <option value="500">Rs.500</option>
                    <option value="800">Rs.800</option>
                    <option value="1000">Rs.1000</option>
                    <option value="1300">Rs.1300</option>
                    <option value="1500">Rs.1500</option>
                    <option value="1800">Rs.1800</option>
                    <option value="2000">Rs.2000</option>
                    <option value="2500">Rs.2500</option>
                    <option value="3000">Rs.3000</option>
					<option value="5000">Rs.5000</option>
					<option value="8000">Rs.8000</option>
                    
          </select>

              </div>
            <div class="col-xs-12 col-md-4">
              <div id="sada" class="col-xs-8 col-md-2"></div>
                <div class="col-xs-4 col-md-2">USD</div>
                  </div>
                </div>
              <div class="row">
                <div class="col-xs-12 col-md-4">
                  <span class="grey-text text-darken-1">Teaching Experience<span class="red-text">*</span></span>
                  <br>
                  <span class="grey-text text-lighten-1" style="font-size: 13px;">In years<br>Both offline and online</span>
                </div>
                <div class="col-xs-8 col-md-4">
                  
                    <select data-condition="simple" class="browser-default" name="teachingexp" id="experience">
                    <option value="<?php echo $value['teachingexp'];?>" selected><?php echo $value['teachingexp'];?></option>
                    <!-- <option value="" disabled selected>Teaching Exp.</option> -->
                    <option value="0">0</option>
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
                     <option value="11">11</option>
                    <option value="12">12</option>
                    <option value="13">13</option>
                    <option value="14">14</option>
                    <option value="15">15</option>
                    <option value="16">16</option>
                    <option value="17">17</option>
                    <option value="18">18</option>
                    <option value="19">19</option>
                    <option value="20">20</option>
                    <option value="21">21</option>
                    <option value="22">22</option>
                    <option value="23">23</option>
                    <option value="24">24</option>
                    <option value="25">25</option>
                    <option value="26">26</option>
                    <option value="27">27</option>
                    <option value="28">28</option>
                    <option value="29">29</option>
                    <option value="30">30</option>
                   
                    
          </select>
                </div>
                  <div class="col-xs-4 col-md-2">
                      Yrs.
                  </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-md-4">
                  <span class="grey-text text-darken-1">Languages<span class="red-text">*</span></span>
                  <br>
                  <span class="grey-text text-lighten-1" style="font-size: 13px;">You are comfortable to teach in</span>
                </div>
                <div class="col-xs-12 col-md-4">
                  <div>
                    <?php 
                      //print_r($value['lang']);
                       $temp=explode('-',$value['lang']); 
                    ?>
                    <input id="lang1" type="checkbox" name="lang1" data-condition="checkbox" data-group="lang" <?php     if( in_array(1, $temp)){?> 
                                    checked="checked" <?php } 
                                     ?>>
                    <label for="lang1">English</label>
                  </div>
                  <div>
                    <input id="lang2" type="checkbox" name="lang2" data-condition="checkbox" data-group="lang" <?php     if( in_array(2, $temp)){?> 
                                    checked="checked" <?php } 
                                     ?>>
                    <label for="lang2">Hindi</label>
                  </div>
                  <div>
                    <input id="lang3" type="checkbox" name="lang3" data-condition="checkbox" data-group="lang" <?php if( in_array(3, $temp)){?> 
                                    checked="checked" <?php } 
                                     ?>>
                    <label for="lang3">Assamese</label>
                  </div>
                  <div>
                    <input id="lang5" type="checkbox" name="lang4" data-condition="checkbox" data-group="lang" <?php if( in_array(4, $temp)){?> 
                                    checked="checked" <?php } 
                                     ?>>
                    <label for="lang5">Sanskrit</label>
                  </div>
                  <div>
                    <input id="lang6" type="checkbox" name="lang5" data-condition="checkbox" data-group="lang" <?php if( in_array(5, $temp)){?> 
                                    checked="checked" <?php } 
                                     ?>>
                    <label for="lang6">Bengali</label>
                  </div>
                  <div>
                    <input id="lang7" type="checkbox" name="lang6" data-condition="checkbox" data-group="lang" <?php if( in_array(6, $temp)){?> 
                                    checked="checked" <?php } 
                                     ?>>
                    <label for="lang7">Mayalayam</label>
                  </div>
                  <div>
                    <input id="lang8" type="checkbox" name="lang7" data-condition="checkbox" data-group="lang" <?php if( in_array(7, $temp)){?> 
                                    checked="checked" <?php } 
                                     ?>>
                    <label for="lang8">Tamil</label>
                  </div>
                </div>
                <div class="col-xs-12 col-md-4">
                  <div>
                    <input id="lang9" type="checkbox" name="lang8" data-condition="checkbox" data-group="lang" <?php if( in_array(8, $temp)){?> 
                                    checked="checked" <?php } 
                                     ?>>
                    <label for="lang9">Gujarati</label>
                  </div>
                  <div>
                    <input id="lang10" type="checkbox" name="lang9" data-condition="checkbox" data-group="lang" <?php if( in_array(9, $temp)){?> 
                                    checked="checked" <?php } 
                                     ?>>
                    <label for="lang10">Marathi</label>
                  </div>
                  <div>
                    <input id="lang11" type="checkbox" name="lang10" data-condition="checkbox" data-group="lang" <?php if( in_array(10, $temp)){?> 
                                    checked="checked" <?php } 
                                     ?>>
                    <label for="lang11">Telugu</label>
                  </div>
                  <div>
                    <input id="lang12" type="checkbox" name="lang11" data-condition="checkbox" data-group="lang" <?php if( in_array(11, $temp)){?> 
                                    checked="checked" <?php } 
                                     ?>>
                    <label for="lang12">Oriya</label>
                  </div>
                  <div>
                    <input id="lang13" type="checkbox" name="lang12" data-condition="checkbox" data-group="lang" <?php if( in_array(12, $temp)){?> 
                                    checked="checked" <?php } 
                                     ?>>
                    <label for="lang13">Urdu</label>
                  </div>
                  <div>
                    <input id="lang14" type="checkbox" name="lang13" data-condition="checkbox" data-group="lang" <?php if( in_array(13, $temp)){?> 
                                    checked="checked" <?php } 
                                     ?>>
                    <label for="lang14">Kannada</label>
                  </div>
                  <div>
                    <input id="lang15" type="checkbox" name="lang14" data-condition="checkbox" data-group="lang" <?php if( in_array(14, $temp)){?> 
                                    checked="checked" <?php } 
                                     ?> >
                    <label for="lang15">Punjabi</label>
                  </div>
                </div>
              </div>
                <div class="row">
                <div class="col-xs-12 col-md-4">
                  <span class="grey-text text-darken-1">College<span class="red-text">*</span></span>
                </div>
                <div class="col-xs-12 col-md-8">
                  <label class="pad"><?php echo 'IIT '.$b['college'];?></label>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-md-4">
                  <span class="grey-text text-darken-1">Degree<span class="red-text">*</span></span>
                </div>
                <div class="col-xs-12 col-md-8">
                  <label class="pad"><?php echo $b['degree'];?></label>
                      
                </div>
              </div>
              
              <div class="row">
                <div class="col-xs-12 col-md-4">
                  <span class="grey-text text-darken-1">branch<span class="red-text">*</span></span>
                  <br>
                  <span class="grey-text text-lighten-1" style="font-size: 13px;">You specialize in</span>
                </div>
                <div class="col-xs-12 col-md-8">
                  <label class="pad"><?php echo $b['branch'];?></label>
                </div>
              </div>
              
              <div class="row">
                <div class="col-xs-12 col-md-4">
                  <span class="grey-text text-darken-1">Email<span class="red-text">*</span></span>
                </div>
                <div class="col-xs-12 col-md-8">
                 <label class="pad"><?php echo $val['email'];?></label>
                </div>
              </div>
                
             
              <div class="row">
                <div class="col-xs-12 col-md-4">
                  <span class="grey-text text-darken-1">Phone Number<span class="red-text">*</span></span>
                    <br>
                    <span class="grey-text text-lighten-1" style="font-size: 13px;">Your mobile no.</span>
                </div>
                <div class="col-xs-6 col-md-4">
                  <label class="pad"><?php echo $val['phone'];?></label>
                    
                </div>
                 <div class="col-xs-6 col-md-3">
                    
                  </div>
                </div>
             
              <div class="row">
                <div class="col-xs-12 col-md-4">
                  <span class="grey-text text-darken-1">Gender<span class="red-text">*</span></span>
                </div>
                <div class="col-xs-12 col-md-8">
                  <label class="pad"><?php if($val['gender']=='f')
                                           echo 'female';
                                           else echo 'male'; ?> </label>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-md-4">
                  <span class="grey-text text-darken-1">Date of Birth<span class="red-text">*</span></span>
                </div>
                <div class="col-xs-12 col-md-6">
                  <input type="date" class="datepicker" name="dob" data-condition="simple"  onchange="ageToTime(this);" style="margin-bottom: 0px;" value="<?php echo date('jS \ F Y',$val['dob']);?>">
                </div>
                  <div class="col-xs-12 col-md-2">
                <div class="col-xs-12 col-md-1"  id="times">
                      
                      </div>
                      <div class="col-xs-12 col-md-1">
                      Yrs.
                      </div>
                  </div>
                </div>
                <div class="row">
                <div class="col-xs-12 col-md-4">
                  <span class="grey-text text-darken-1">Are you Ok with home tuition?<span class="red-text">*</span></span>
                  <br>
                  
                </div>
                <div class="col-xs-12 col-md-4">
                  <div>
                    <input id="home1" type="radio"  name="home1" 
                                    <?php if($b['home']==1){?> 
                                    checked="checked" <?php } 
                                     ?>>
                    <label for="home1">Yes</label>
                  </div>
                  <div>
                    <input id="home2" type="radio"  name="home1"
                                    <?php if($b['home']==2){?> 
                                    checked="checked" <?php } 
                                     ?> >
                    <label for="home2">No</label>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-md-4">
                  <span class="grey-text text-darken-1">Address<span class="red-text">*</span></span>
                </div>
                <div class="col-xs-12 col-md-4">
                                            
                    <div><input placeholder="City" type="text" class="validate" name="city" data-condition="simple" length=17 value="<?php echo $b['city'];?>"></div>
                    <div><input placeholder="Postal/Zip Code" type="text" class="validate" name="zipcode" data-condition="simple" length=6 value="<?php echo $b['zipcode'];?>" ></div>
                </div>
                <div class="col-xs-12 col-md-4">
                    <div><input placeholder="State/Province" type="text" class="validate" name="state" data-condition="simple" length=20 value="<?php echo $b['state'];?>"></div>
                  <select name="country"  class="browser-default" data-condition="simple">
                    <option value="<?php echo $b['country'];?>" selected ><?php echo $b['country'];?></option>
                     <!-- <option value="" disabled selected>Country</option>  -->
                    
                    <option value="Afghanistan"> Afghanistan </option>
                    <option value="Albania"> Albania </option>
                    <option value="Algeria"> Algeria </option>
                    <option value="American Samoa"> American Samoa </option>
                    <option value="Andorra"> Andorra </option>
                    <option value="Angola"> Angola </option>
                    <option value="Anguilla"> Anguilla </option>
                    <option value="Antigua and Barbuda"> Antigua and Barbuda </option>
                    <option value="Argentina"> Argentina </option>
                    <option value="Armenia"> Armenia </option>
                    <option value="Aruba"> Aruba </option>
                    <option value="Australia"> Australia </option>
                    <option value="Austria"> Austria </option>
                    <option value="Azerbaijan"> Azerbaijan </option>
                    <option value="The Bahamas"> The Bahamas </option>
                    <option value="Bahrain"> Bahrain </option>
                    <option value="Bangladesh"> Bangladesh </option>
                    <option value="Barbados"> Barbados </option>
                    <option value="Belarus"> Belarus </option>
                    <option value="Belgium"> Belgium </option>
                    <option value="Belize"> Belize </option>
                    <option value="Benin"> Benin </option>
                    <option value="Bermuda"> Bermuda </option>
                    <option value="Bhutan"> Bhutan </option>
                    <option value="Bolivia"> Bolivia </option>
                    <option value="Bosnia and Herzegovina"> Bosnia and Herzegovina </option>
                    <option value="Botswana"> Botswana </option>
                    <option value="Brazil"> Brazil </option>
                    <option value="Brunei"> Brunei </option>
                    <option value="Bulgaria"> Bulgaria </option>
                    <option value="Burkina Faso"> Burkina Faso </option>
                    <option value="Burundi"> Burundi </option>
                    <option value="Cambodia"> Cambodia </option>
                    <option value="Cameroon"> Cameroon </option>
                    <option value="Canada"> Canada </option>
                    <option value="Cape Verde"> Cape Verde </option>
                    <option value="Cayman Islands"> Cayman Islands </option>
                    <option value="Central African Republic"> Central African Republic </option>
                    <option value="Chad"> Chad </option>
                    <option value="Chile"> Chile </option>
                    <option value="People's Republic of China"> People's Republic of China </option>
                    <option value="Republic of China"> Republic of China </option>
                    <option value="Christmas Island"> Christmas Island </option>
                    <option value="Cocos (Keeling) Islands"> Cocos (Keeling) Islands </option>
                    <option value="Colombia"> Colombia </option>
                    <option value="Comoros"> Comoros </option>
                    <option value="Congo"> Congo </option>
                    <option value="Cook Islands"> Cook Islands </option>
                    <option value="Costa Rica"> Costa Rica </option>
                    <option value="Cote d'Ivoire"> Cote d'Ivoire </option>
                    <option value="Croatia"> Croatia </option>
                    <option value="Cuba"> Cuba </option>
                    <option value="Cyprus"> Cyprus </option>
                    <option value="Czech Republic"> Czech Republic </option>
                    <option value="Denmark"> Denmark </option>
                    <option value="Djibouti"> Djibouti </option>
                    <option value="Dominica"> Dominica </option>
                    <option value="Dominican Republic"> Dominican Republic </option>
                    <option value="Ecuador"> Ecuador </option>
                    <option value="Egypt"> Egypt </option>
                    <option value="El Salvador"> El Salvador </option>
                    <option value="Equatorial Guinea"> Equatorial Guinea </option>
                    <option value="Eritrea"> Eritrea </option>
                    <option value="Estonia"> Estonia </option>
                    <option value="Ethiopia"> Ethiopia </option>
                    <option value="Falkland Islands"> Falkland Islands </option>
                    <option value="Faroe Islands"> Faroe Islands </option>
                    <option value="Fiji"> Fiji </option>
                    <option value="Finland"> Finland </option>
                    <option value="France"> France </option>
                    <option value="French Polynesia"> French Polynesia </option>
                    <option value="Gabon"> Gabon </option>
                    <option value="The Gambia"> The Gambia </option>
                    <option value="Georgia"> Georgia </option>
                    <option value="Germany"> Germany </option>
                    <option value="Ghana"> Ghana </option>
                    <option value="Gibraltar"> Gibraltar </option>
                    <option value="Greece"> Greece </option>
                    <option value="Greenland"> Greenland </option>
                    <option value="Grenada"> Grenada </option>
                    <option value="Guadeloupe"> Guadeloupe </option>
                    <option value="Guam"> Guam </option>
                    <option value="Guatemala"> Guatemala </option>
                    <option value="Guernsey"> Guernsey </option>
                    <option value="Guinea"> Guinea </option>
                    <option value="Guinea-Bissau"> Guinea-Bissau </option>
                    <option value="Guyana"> Guyana </option>
                    <option value="Haiti"> Haiti </option>
                    <option value="Honduras"> Honduras </option>
                    <option value="Hong Kong"> Hong Kong </option>
                    <option value="Hungary"> Hungary </option>
                    <option value="Iceland"> Iceland </option>
                    <option value="India"> India </option>
                    <option value="Indonesia"> Indonesia </option>
                    <option value="Iran"> Iran </option>
                    <option value="Iraq"> Iraq </option>
                    <option value="Ireland"> Ireland </option>
                    <option value="Israel"> Israel </option>
                    <option value="Italy"> Italy </option>
                    <option value="Jamaica"> Jamaica </option>
                    <option value="Japan"> Japan </option>
                    <option value="Jersey"> Jersey </option>
                    <option value="Jordan"> Jordan </option>
                    <option value="Kazakhstan"> Kazakhstan </option>
                    <option value="Kenya"> Kenya </option>
                    <option value="Kiribati"> Kiribati </option>
                    <option value="North Korea"> North Korea </option>
                    <option value="South Korea"> South Korea </option>
                    <option value="Kosovo"> Kosovo </option>
                    <option value="Kuwait"> Kuwait </option>
                    <option value="Kyrgyzstan"> Kyrgyzstan </option>
                    <option value="Laos"> Laos </option>
                    <option value="Latvia"> Latvia </option>
                    <option value="Lebanon"> Lebanon </option>
                    <option value="Lesotho"> Lesotho </option>
                    <option value="Liberia"> Liberia </option>
                    <option value="Libya"> Libya </option>
                    <option value="Liechtenstein"> Liechtenstein </option>
                    <option value="Lithuania"> Lithuania </option>
                    <option value="Luxembourg"> Luxembourg </option>
                    <option value="Macau"> Macau </option>
                    <option value="Macedonia"> Macedonia </option>
                    <option value="Madagascar"> Madagascar </option>
                    <option value="Malawi"> Malawi </option>
                    <option value="Malaysia"> Malaysia </option>
                    <option value="Maldives"> Maldives </option>
                    <option value="Mali"> Mali </option>
                    <option value="Malta"> Malta </option>
                    <option value="Marshall Islands"> Marshall Islands </option>
                    <option value="Martinique"> Martinique </option>
                    <option value="Mauritania"> Mauritania </option>
                    <option value="Mauritius"> Mauritius </option>
                    <option value="Mayotte"> Mayotte </option>
                    <option value="Mexico"> Mexico </option>
                    <option value="Micronesia"> Micronesia </option>
                    <option value="Moldova"> Moldova </option>
                    <option value="Monaco"> Monaco </option>
                    <option value="Mongolia"> Mongolia </option>
                    <option value="Montenegro"> Montenegro </option>
                    <option value="Montserrat"> Montserrat </option>
                    <option value="Morocco"> Morocco </option>
                    <option value="Mozambique"> Mozambique </option>
                    <option value="Myanmar"> Myanmar </option>
                    <option value="Nagorno-Karabakh"> Nagorno-Karabakh </option>
                    <option value="Namibia"> Namibia </option>
                    <option value="Nauru"> Nauru </option>
                    <option value="Nepal"> Nepal </option>
                    <option value="Netherlands"> Netherlands </option>
                    <option value="Netherlands Antilles"> Netherlands Antilles </option>
                    <option value="New Caledonia"> New Caledonia </option>
                    <option value="New Zealand"> New Zealand </option>
                    <option value="Nicaragua"> Nicaragua </option>
                    <option value="Niger"> Niger </option>
                    <option value="Nigeria"> Nigeria </option>
                    <option value="Niue"> Niue </option>
                    <option value="Norfolk Island"> Norfolk Island </option>
                    <option value="Turkish Republic of Northern Cyprus"> Turkish Republic of Northern Cyprus </option>
                    <option value="Northern Mariana"> Northern Mariana </option>
                    <option value="Norway"> Norway </option>
                    <option value="Oman"> Oman </option>
                    <option value="Pakistan"> Pakistan </option>
                    <option value="Palau"> Palau </option>
                    <option value="Palestine"> Palestine </option>
                    <option value="Panama"> Panama </option>
                    <option value="Papua New Guinea"> Papua New Guinea </option>
                    <option value="Paraguay"> Paraguay </option>
                    <option value="Peru"> Peru </option>
                    <option value="Philippines"> Philippines </option>
                    <option value="Pitcairn Islands"> Pitcairn Islands </option>
                    <option value="Poland"> Poland </option>
                    <option value="Portugal"> Portugal </option>
                    <option value="Puerto Rico"> Puerto Rico </option>
                    <option value="Qatar"> Qatar </option>
                    <option value="Romania"> Romania </option>
                    <option value="Russia"> Russia </option>
                    <option value="Rwanda"> Rwanda </option>
                    <option value="Saint Barthelemy"> Saint Barthelemy </option>
                    <option value="Saint Helena"> Saint Helena </option>
                    <option value="Saint Kitts and Nevis"> Saint Kitts and Nevis </option>
                    <option value="Saint Lucia"> Saint Lucia </option>
                    <option value="Saint Martin"> Saint Martin </option>
                    <option value="Saint Pierre and Miquelon"> Saint Pierre and Miquelon </option>
                    <option value="Saint Vincent and the Grenadines"> Saint Vincent and the Grenadines </option>
                    <option value="Samoa"> Samoa </option>
                    <option value="San Marino"> San Marino </option>
                    <option value="Sao Tome and Principe"> Sao Tome and Principe </option>
                    <option value="Saudi Arabia"> Saudi Arabia </option>
                    <option value="Senegal"> Senegal </option>
                    <option value="Serbia"> Serbia </option>
                    <option value="Seychelles"> Seychelles </option>
                    <option value="Sierra Leone"> Sierra Leone </option>
                    <option value="Singapore"> Singapore </option>
                    <option value="Slovakia"> Slovakia </option>
                    <option value="Slovenia"> Slovenia </option>
                    <option value="Solomon Islands"> Solomon Islands </option>
                    <option value="Somalia"> Somalia </option>
                    <option value="Somaliland"> Somaliland </option>
                    <option value="South Africa"> South Africa </option>
                    <option value="South Ossetia"> South Ossetia </option>
                    <option value="Spain"> Spain </option>
                    <option value="Sri Lanka"> Sri Lanka </option>
                    <option value="Sudan"> Sudan </option>
                    <option value="Suriname"> Suriname </option>
                    <option value="Svalbard"> Svalbard </option>
                    <option value="Swaziland"> Swaziland </option>
                    <option value="Sweden"> Sweden </option>
                    <option value="Switzerland"> Switzerland </option>
                    <option value="Syria"> Syria </option>
                    <option value="Taiwan"> Taiwan </option>
                    <option value="Tajikistan"> Tajikistan </option>
                    <option value="Tanzania"> Tanzania </option>
                    <option value="Thailand"> Thailand </option>
                    <option value="Timor-Leste"> Timor-Leste </option>
                    <option value="Togo"> Togo </option>
                    <option value="Tokelau"> Tokelau </option>
                    <option value="Tonga"> Tonga </option>
                    <option value="Transnistria Pridnestrovie"> Transnistria Pridnestrovie </option>
                    <option value="Trinidad and Tobago"> Trinidad and Tobago </option>
                    <option value="Tristan da Cunha"> Tristan da Cunha </option>
                    <option value="Tunisia"> Tunisia </option>
                    <option value="Turkey"> Turkey </option>
                    <option value="Turkmenistan"> Turkmenistan </option>
                    <option value="Turks and Caicos Islands"> Turks and Caicos Islands </option>
                    <option value="Tuvalu"> Tuvalu </option>
                    <option value="Uganda"> Uganda </option>
                    <option value="Ukraine"> Ukraine </option>
                    <option value="United Arab Emirates"> United Arab Emirates </option>
                    <option value="United Kingdom"> United Kingdom </option>
                      <option value="United States"> United States </option>
                    <option value="Uruguay"> Uruguay </option>
                    <option value="Uzbekistan"> Uzbekistan </option>
                    <option value="Vanuatu"> Vanuatu </option>
                    <option value="Vatican City"> Vatican City </option>
                    <option value="Venezuela"> Venezuela </option>
                    <option value="Vietnam"> Vietnam </option>
                    <option value="British Virgin Islands"> British Virgin Islands </option>
                    <option value="Isle of Man"> Isle of Man </option>
                    <option value="US Virgin Islands"> US Virgin Islands </option>
                    <option value="Wallis and Futuna"> Wallis and Futuna </option>
                    <option value="Western Sahara"> Western Sahara </option>
                    <option value="Yemen"> Yemen </option>
                    <option value="Zambia"> Zambia </option>
                    <option value="Zimbabwe"> Zimbabwe </option>
                    <option value="other"> Other </option>
                  </select>
                </div>
              </div>
               <?php
              }}
                ?>                
                <div class="row">
                <div class="col-xs-12 col-md-4">
                  <span class="grey-text text-darken-1">Resume<span class="red-text">*</span></span>
                    <br>
                    <span class="grey-text text-lighten-1" style="font-size: 13px;">Please upload your updated resume in PDF format</span>
                </div>
                <div class="col-xs-12 col-md-8">
                  <div class="file-field input-field">
                  <input class="file-path validate" type="text">
                    <div class="btn">
                      <span>Open</span>
                      <input type="file" name="resumefile" >
                    </div>
                     <a href="<?php echo $b['resume']; ?>">Click here to see your previous resume.</a>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-xs-12 col-md-4">
                  <span class="grey-text text-darken-1">Linkedin Profile</span>
                  <br>
                  <span class="grey-text text-lighten-1" style="font-size: 13px;">Enter full URL</span>
                </div>
                <div class="col-xs-12 col-md-8">
                  <input placeholder="https://" type="url" class="validate" name="linkprofile" length=55 value="<?php echo $b['linkprofile'];?>">
                </div>
              </div>
              
              <div class="row">
                <div class="col-xs-12 col-md-8 col-md-offset-4">
                  <button class="btn waves-effect waves-light" type="submit" name="action" data-target="modal1" >Submit
                    <i class="mdi-content-send right"></i> 
                  </button>
                
                  </div>
              </div>
                <!-- Modal Structure -->
  <div id="modal1" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4>Modal Header</h4>
      <p>A bunch of text</p>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat ">Agree</a>
    </div>
  </div>
              <div class="row">
                <div class="col-xs-12">
                  <span class="red-text">* marked fields are mandatory</span>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<?php
}
else{
 $_SESSION['msg11']= $msg;
    Fun::redirect(BASE."profile/".$tid);//Thank You message
}
load_view("Template/footernew.php");
?>
<script>
    function f(obj){
    var value1=$(obj).val();
    var value2=<?php echo $currentDollarRate = simplexml_load_file("http://www.webservicex.net/CurrencyConvertor.asmx/ConversionRate?FromCurrency=INR&ToCurrency=USD");?> 
    var x = Math.round(value1*value2);
    $("#sada").html(x);
  }
    function other(obj){
    var temp = obj.value;
        if (temp ==="other")
        {
        $("#otherType").show()
        }
        else
        {
            $("#otherType").hide()
        }
    }

        
    function ageToTime(obj){
    var d = new Date();
    var n1 = d.getFullYear(); 
    var d = new Date(obj.value);
    var n2 = d.getFullYear(); 
    $("#times").html(n1-n2);
  }
</script>
<?php

load_view("Template/bottom.php");
?>
