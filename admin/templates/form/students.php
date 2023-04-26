 <SCRIPT src="http://code.jquery.com/jquery-2.1.1.js"></SCRIPT>
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
 <script type = "text/javascript" language = "javascript">
         function display_input(path,container,by_id){
			  $.ajax({
								type:'POST',
								url:path,
								data:{'by_id':by_id },
								success: function(option_tags) {
									
									$('#'+container).html(option_tags);
								}
						});
		 }
		
		 function display_input_field(path,container,by_id){ 
			 var exist_sibling=$('#existing_sibling').val();
			  $.ajax({
								type:'POST',
								url:path,
								data:{'by_id':by_id, 'exist_sibling' : exist_sibling},
								success: function(option_tags) {
									$('#'+container).html(option_tags);
								}
						});
		 }
		 
		
		function percentage_calculation(by_id,counter){ 
			if($('#'+by_id+'_marks_'+counter).val() !="" && $('#'+by_id+'_outof_'+counter).val()){
			 	var mark_value=$('#'+by_id+'_marks_'+counter).val();
			  	var outof=$('#'+by_id+'_outof_'+counter).val();
			  
				$.ajax({
								type:'POST',
								url:'../ajax/percentage.php',
								data:{'by_id' : by_id, 'counter':counter, 'mark_value' : mark_value, 'outof': outof},
								success: function(option_tags) {
									$('#divPercentage_'+by_id+'_'+counter).html(option_tags);
								}
						});
			}
			else{
				alert("Fill the marks fields");
				return false;
				}
			
			}
</script>
<script>
function check_file_type(){ 
	var x = document.getElementById("FileUploader");
	alert(x);
	var files = x.files;
	var file_type = files.type; 
	//var name = files[0].name; 
		if (!(file_type ==='application/jpeg' || file_type ==='application/jpg')) {
				alert("Please upload jpg or jpeg file only");
				$('#FilUploader').attr({ value: '' });
				return false;
           	
            }
			else{ return true;}
	
		//alert($('input[name="files[]"]').eq(0).val());
	}
</script>
<script>	
function displayquestion(container){
  $("#"+container).show();
}


function add_array(by_id, container, path){ 
	var info = [];
	if(by_id=='parish'){
		info[0] = $('#parish_field').val();
		info[1] = $('#parish_vicari').val();
		info[2] = $('#parish_phone').val();
		info[3]= $('#vicari_address').val();
		if($('#diocese_id').val() !=""){
		var second_id = $('#diocese_id').val();
		}
		else { alert("Select Diocese field");}
	}
	if(by_id=='parish_teacher'){
		info[0] = $('#teacher_name').val();
		info[1] = $('#teacher_email').val();
		info[2] = $('#teacher_phone').val();
		info[3]= $('#teacher_address').val();
		var second_id = $('#parish_id').val();
	}
	if(by_id=='vp_details'){
		info[0] = $('#vp_name').val();
		info[1] = $('#vp_phone').val();
		info[2] = $('#vp_address').val();
		info[3]= $('#vp_whatsup').val();
		info[4]= $('#vp_fb').val();
		var second_id='0'; 
	}
	$.ajax({
            type: "POST",
            url: path,
            data:  {'info' : info, 'by_id' : by_id, 'second_id' : second_id} ,
           	success: function(option_tags) { 
									
				$('#'+container).html(option_tags);
				alert("Successfully Added");
									 $("#main_"+container).hide();
            }
        });
	}

function add(id, container, path){ 
	
	if(id=='student_cat'){
		 var name = $('#cat_name').val(); 
	}
	else if(id=='class'){
		 var name = $('#class_name').val();
	}
	else if(id=='family_financial'){
		 var name = $('#financial_status').val();
	}
	else if(id=='reputation_in_parish'){ 
		 var name = $('#reputaion_parish_field').val();
	}
	else if(id=='relation_with_p'){ 
		 var name = $('#relation_field').val();
	}
	else if(id=='church_g'){ 
	 var name = $('#church_going_field').val();
	}
	else if(id=='quality'){ 
	 var name = $('#quality_field').val();
	}
	else if(id=='s_syllabus'){ 
	 var name = $('#syllabus_field').val();
	}
	else if(id=='name_title'){ 
	 var name = $('#title_field').val();
	}
	else if(id=='exam_model'){
		 var name = $('#model_field').val();
	}
	else if(id=='study_status'){
		 var name = $('#s_status_field').val();
	}
	else if(id=='diocese_add'){
		 var name = $('#diocese_field').val();
	}
	/*else if(id=='parish_add'){
		 var name = $('#parish_field').val();
	}*/
	else if(id=='interest_to_priest'){
		 var name = $('#interest_priest_field').val();
	}
	else if(id=='question_type'){
		var name = $('#questiontype_field').val();
	}
	else if(id=='family_prayer_conduct'){
		var name = $('#family_prayer_field').val();
	}
	else if(id=='kurbana_attend'){
		var name = $('#kurbana_attend_field').val();
	}
	else if(id=='previous_school'){
		var name = $('#previous_school_field').val();
	}
	$.ajax({
								type:'POST',
								url:path,
								data:{'name': name, 'by_id' : id},
								success: function(option_tags) {
									
									$('#'+container).html(option_tags);
									alert("Successfully Added");
									 $("#main_"+container).hide();
								}
						});
}


	</script>
    
    <script type="text/javascript">
	$(document).ready(function(){
		$val= $('#state').val();
		selct_district($val);
		});
		
		

/*$(document).ready(function(){

    var counter = $('#counter').val();

    $("#addButton").click(function () {

    if(counter>10){
            alert("Only 10 textboxes allow");
            return false;
    }   

    var newTextBoxDiv = $(document.createElement('div'))
         .attr("id", 'TextBoxDiv' + counter);

    newTextBoxDiv.after().html('Ques.'+ counter + ' : ' +
          '<input type="text" name="question[]" id="question' + counter + '" class="form-control" ><br>Ans.'+ counter + ' : ' +
          '<input type="text" name="answer[]" id="answer' + counter + '" class="form-control" >');

    newTextBoxDiv.appendTo("#TextBoxesGroup");


    counter++;
     });

     $("#removeButton").click(function () {
    if(counter==1){
          alert("No more textbox to remove");
          return false;
       }   

    counter--;

        $("#TextBoxDiv" + counter).remove();

     });

     $("#getButtonValue").click(function () {

    var msg = '';
    for(i=1; i<counter; i++){
      msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
    }
          alert(msg);
     });
  });*/
</script>
<script type="text/javascript">
	function delete_by_id(by_id, path, container){
		var r = confirm("Do you want to delete this item?");
		if (r == true) {
			
			$.ajax({
					type:'POST',
					url:path,
					data:{ 'by_id' : by_id},
					success: function(option_tags) {
						
						$('#'+container).html(option_tags);
						alert("Successfully Deleted");
						$("#divQuestionType").load();
					}
			});

			
		} else {
			return false;
		}
		
	}
	</script>
    <script type="text/javascript">
	function toggle_div(id){
		  $("#show_part_"+id).toggle();
	}
</script>
<!-- <script>  
        $(document).ready(function() {  
		
		
		 var counter1 = $('#prev_counter').val();

    $("#Add").click(function () {

    if(counter1>10){
            alert("Only 10 textboxes allow");
            return false;
    }   

    var newTextBoxDiv = $(document.createElement('div'))
         .attr("id", 'previous_historyDiv' + counter1);

    newTextBoxDiv.after().html('School.'+ counter1 + ' : ' +
          '<input type="text" name="previous_school_name[]"  id="previous_school' + counter1 + '" class="form-control" ><br>Syllabus.'+ counter1 + ' : ' +
          '<input type="text" name="previous_syllabus[]"  id="previous_syllabus' + counter1 + '" class="form-control" ><br>Place.'+ counter1 + ' : '+ '<input type="text" name="previous_school_place[]"  id="previous_school_place'+ counter1 + '" class="form-control" > ');

    newTextBoxDiv.appendTo("#TextBoxesGroup2");


    counter1++;
     });

     $("#Remove").click(function () {
    if(counter1==1){
          alert("No more textbox to remove");
          return false;
       }   

    counter1--;

        $("#prev_historyDiv" + counter1).remove();

     });

     $("#getButtonValue").click(function () {

    var msg = '';
    for(i=1; i<counter1; i++){
      msg += "\n Textbox #" + i + " : " + $('#textbox' + i).val();
    }
          alert(msg);
     });
		
        });  
    </script>-->
   
    <script>

function selct_district($val)
{
	$val= $('#state').val();
    if($val=='SELECT STATE') {
	   var options = '';
	  $('#district').html(options);
  }
 if($val=='Andhra Pradesh') {
   var andhra = ["Anantapur","Chittoor","East Godavari","Guntur","Krishna","Kurnool","Prakasam","Srikakulam","SriPotti Sri Ramulu Nellore",
                                    "Vishakhapatnam","Vizianagaram","West Godavari","Cudappah"];
   $(function() {
  var options = '';
  for (var i = 0; i < andhra.length; i++) {
      options += '<option value="' + andhra[i] + '">' + andhra[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  if ($val=='Arunachal Pradesh') {
    var ap = ["Anjaw","Changlang","Dibang Valley","East Siang","East Kameng","Kurung Kumey","Lohit","Longding","Lower Dibang Valley","Lower Subansiri","Papum Pare",
                                        "Tawang","Tirap","Upper Siang","Upper Subansiri","West Kameng","West Siang"];
   $(function() {
  var options = '';
  for (var i = 0; i < ap.length; i++) {
      options += '<option value="' + ap[i] + '">' + ap[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  if ($val=='Assam') {
    var assam = ["Baksa","Barpeta","Bongaigaon","Cachar","Chirang","Darrang","Dhemaji","Dima Hasao","Dhubri","Dibrugarh","Goalpara","Golaghat","Hailakandi","Jorhat",
                                     "Kamrup","Kamrup Metropolitan","Karbi Anglong","Karimganj","Kokrajhar","Lakhimpur","Morigaon","Nagaon","Nalbari","Sivasagar","Sonitpur","Tinsukia","Udalguri"];
   $(function() {
  var options = '';
  for (var i = 0; i < assam.length; i++) {
      options += '<option value="' + assam[i] + '">' + assam[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  if ($val=='Bihar') {
    var bihar = ["Araria","Arwal","Aurangabad","Banka","Begusarai","Bhagalpur","Bhojpur","Buxar","Darbhanga","East Champaran","Gaya","Gopalganj","Jamui","Jehanabad","Kaimur",
                                        "Katihar","Khagaria","Kishanganj","Lakhisarai","Madhepura","Madhubani","Munger","Muzaffarpur","Nalanda","Nawada","Patna","Purnia","Rohtas","Saharsa",
                                        "Samastipur","Saran","Sheikhpura","Sheohar","Sitamarhi","Siwan","Supaul","Vaishali","West Champaran"];
   $(function() {
  var options = '';
  for (var i = 0; i < bihar.length; i++) {
      options += '<option value="' + bihar[i] + '">' + bihar[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  if ($val=='Chhattisgarh') {
    var Chhattisgarh = ["Bastar","Bijapur","Bilaspur","Dantewada","Dhamtari","Durg","Jashpur","Janjgir-Champa","Korba","Koriya","Kanker","Kabirdham (formerly Kawardha)","Mahasamund",
                                            "Narayanpur","Raigarh","Rajnandgaon","Raipur","Surajpur","Surguja"];
   $(function() {
  var options = '';
  for (var i = 0; i < Chhattisgarh.length; i++) {
      options += '<option value="' + Chhattisgarh[i] + '">' + Chhattisgarh[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  if ($val=='Dadra and Nagar Haveli') {
    var dadra = ["Amal","Silvassa"];
   $(function() {
  var options = '';
  for (var i = 0; i < dadra.length; i++) {
      options += '<option value="' + dadra[i] + '">' + dadra[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  if ($val=='Daman and Diu') {
    var daman = ["Daman","Diu"];
   $(function() {
  var options = '';
  for (var i = 0; i < daman.length; i++) {
      options += '<option value="' + daman[i] + '">' + daman[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  if ($val=='Delhi') {
    var delhi = ["Delhi","New Delhi","North Delhi","Noida","Patparganj","Sonabarsa","Tughlakabad"];
   $(function() {
  var options = '';
  for (var i = 0; i < delhi.length; i++) {
      options += '<option value="' + delhi[i] + '">' + delhi[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  if ($val=='Goa') {
    var goa = ["Chapora","Dabolim","Madgaon","Marmugao (Marmagao)","Panaji Port","Panjim","Pellet Plant Jetty/Shiroda","Talpona","Vasco da Gama"];
   $(function() {
  var options = '';
  for (var i = 0; i < goa.length; i++) {
      options += '<option value="' + goa[i] + '">' + goa[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  if ($val=='Gujarat') {
    var gujarat = ["Ahmedabad","Amreli district","Anand","Aravalli","Banaskantha","Bharuch","Bhavnagar","Dahod","Dang","Gandhinagar","Jamnagar","Junagadh",
                                        "Kutch","Kheda","Mehsana","Narmada","Navsari","Patan","Panchmahal","Porbandar","Rajkot","Sabarkantha","Surendranagar","Surat","Tapi","Vadodara","Valsad"];
   $(function() {
  var options = '';
  for (var i = 0; i < gujarat.length; i++) {
      options += '<option value="' + gujarat[i] + '">' + gujarat[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  if ($val=='Haryana') {
    var haryana = ["Ambala","Bhiwani","Faridabad","Fatehabad","Gurgaon","Hissar","Jhajjar","Jind","Karnal","Kaithal",
                                            "Kurukshetra","Mahendragarh","Mewat","Palwal","Panchkula","Panipat","Rewari","Rohtak","Sirsa","Sonipat","Yamuna Nagar"];
   $(function() {
  var options = '';
  for (var i = 0; i < haryana.length; i++) {
      options += '<option value="' + haryana[i] + '">' + haryana[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  
  if ($val=='Himachal Pradesh') {
    var himachal = ["Baddi","Baitalpur","Chamba","Dharamsala","Hamirpur","Kangra","Kinnaur","Kullu","Lahaul & Spiti","Mandi","Simla","Sirmaur","Solan","Una"];
   $(function() {
  var options = '';
  for (var i = 0; i < himachal.length; i++) {
      options += '<option value="' + himachal[i] + '">' + himachal[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  if ($val=='Jammu and Kashmir') {
    var jammu = ["Jammu","Leh","Rajouri","Srinagar"];
   $(function() {
  var options = '';
  for (var i = 0; i < jammu.length; i++) {
      options += '<option value="' + jammu[i] + '">' + jammu[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  if ($val=='Jharkhand') {
    var jharkhand = ["Bokaro","Chatra","Deoghar","Dhanbad","Dumka","East Singhbhum","Garhwa","Giridih","Godda","Gumla","Hazaribag","Jamtara","Khunti","Koderma","Latehar","Lohardaga","Pakur","Palamu",
                                            "Ramgarh","Ranchi","Sahibganj","Seraikela Kharsawan","Simdega","West Singhbhum"];
   $(function() {
  var options = '';
  for (var i = 0; i < jharkhand.length; i++) {
      options += '<option value="' + jharkhand[i] + '">' + jharkhand[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  if ($val=='Karnataka') {
    var karnataka = ["Bagalkot","Bangalore","Bangalore Urban","Belgaum","Bellary","Bidar","Bijapur","Chamarajnagar", "Chikkamagaluru","Chikkaballapur",
                                           "Chitradurga","Davanagere","Dharwad","Dakshina Kannada","Gadag","Gulbarga","Hassan","Haveri district","Kodagu",
                                           "Kolar","Koppal","Mandya","Mysore","Raichur","Shimoga","Tumkur","Udupi","Uttara Kannada","Ramanagara","Yadgir"];
   $(function() {
  var options = '';
  for (var i = 0; i < karnataka.length; i++) {
      options += '<option value="' + karnataka[i] + '">' + karnataka[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  if ($val=='Kerala') {
    var kerala = ["Alappuzha","Ernakulam","Idukki","Kannur","Kasaragod","Kollam","Kottayam","Kozhikode","Malappuram","Palakkad","Pathanamthitta","Thrissur","Thiruvananthapuram","Wayanad"];
   $(function() {
  var options = '';
  for (var i = 0; i < kerala.length; i++) {
      options += '<option value="' + kerala[i] + '">' + kerala[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  if ($val=='Madhya Pradesh') {
    var mp = ["Alirajpur","Anuppur","Ashoknagar","Balaghat","Barwani","Betul","Bhilai","Bhind","Bhopal","Burhanpur","Chhatarpur","Chhindwara","Damoh","Dewas","Dhar","Guna","Gwalior","Hoshangabad",
                                    "Indore","Itarsi","Jabalpur","Khajuraho","Khandwa","Khargone","Malanpur","Malanpuri (Gwalior)","Mandla","Mandsaur","Morena","Narsinghpur","Neemuch","Panna","Pithampur","Raipur","Raisen","Ratlam",
                                    "Rewa","Sagar","Satna","Sehore","Seoni","Shahdol","Singrauli","Ujjain"];
   $(function() {
  var options = '';
  for (var i = 0; i < mp.length; i++) {
      options += '<option value="' + mp[i] + '">' + mp[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  if ($val=='Maharashtra') {
    var maharashtra = ["Ahmednagar","Akola","Alibag","Amaravati","Arnala","Aurangabad","Aurangabad","Bandra","Bassain","Belapur","Bhiwandi","Bhusaval","Borliai-Mandla","Chandrapur","Dahanu","Daulatabad","Dighi (Pune)","Dombivali","Goa","Jaitapur","Jalgaon",
                                             "Jawaharlal Nehru (Nhava Sheva)","Kalyan","Karanja","Kelwa","Khopoli","Kolhapur","Lonavale","Malegaon","Malwan","Manori",
                                             "Mira Bhayandar","Miraj","Mumbai (ex Bombay)","Murad","Nagapur","Nagpur","Nalasopara","Nanded","Nandgaon","Nasik","Navi Mumbai","Nhave","Osmanabad","Palghar",
                                             "Panvel","Pimpri","Pune","Ratnagiri","Sholapur","Shrirampur","Shriwardhan","Tarapur","Thana","Thane","Trombay","Varsova","Vengurla","Virar","Wada"];
   $(function() {
  var options = '';
  for (var i = 0; i < maharashtra.length; i++) {
      options += '<option value="' + maharashtra[i] + '">' + maharashtra[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
   if ($val=='Manipur') {
    var manipur = ["Bishnupur","Churachandpur","Chandel","Imphal East","Senapati","Tamenglong","Thoubal","Ukhrul","Imphal West"];
   $(function() {
  var options = '';
  for (var i = 0; i < manipur.length; i++) {
      options += '<option value="' + manipur[i] + '">' + manipur[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
   if ($val=='Meghalaya') {
    var meghalaya = ["Baghamara","Balet","Barsora","Bolanganj","Dalu","Dawki","Ghasuapara","Mahendraganj","Moreh","Ryngku","Shella Bazar","Shillong"];
   $(function() {
  var options = '';
  for (var i = 0; i < meghalaya.length; i++) {
      options += '<option value="' + meghalaya[i] + '">' + meghalaya[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
   if ($val=='Mizoram') {
    var mizoram = ["Aizawl","Champhai","Kolasib","Lawngtlai","Lunglei","Mamit","Saiha","Serchhip"];
   $(function() {
  var options = '';
  for (var i = 0; i < mizoram.length; i++) {
      options += '<option value="' + mizoram[i] + '">' + mizoram[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
   if ($val=='Nagaland') {
    var nagaland = ["Dimapur","Kiphire","Kohima","Longleng","Mokokchung","Mon","Peren","Phek","Tuensang","Wokha","Zunheboto"];
   $(function() {
  var options = '';
  for (var i = 0; i < nagaland.length; i++) {
      options += '<option value="' + nagaland[i] + '">' + nagaland[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  if ($val=='Orissa') {
    var orissa = ["Bahabal Pur","Bhubaneswar","Chandbali","Gopalpur","Jeypore","Paradip Garh","Puri","Rourkela"];
   $(function() {
  var options = '';
  for (var i = 0; i < orissa.length; i++) {
      options += '<option value="' + orissa[i] + '">' + orissa[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  if ($val=='Puducherry') {
    var puducherry = ["Karaikal","Mahe","Pondicherry","Yanam"];
   $(function() {
  var options = '';
  for (var i = 0; i < puducherry.length; i++) {
      options += '<option value="' + puducherry[i] + '">' + puducherry[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  if ($val=='Punjab') {
    var punjab = ["Amritsar","Barnala","Bathinda","Firozpur","Faridkot","Fatehgarh Sahib","Fazilka","Gurdaspur","Hoshiarpur","Jalandhar","Kapurthala","Ludhiana","Mansa","Moga","Sri Muktsar Sahib","Pathankot",
                                        "Patiala","Rupnagar","Ajitgarh (Mohali)","Sangrur","Shahid Bhagat Singh Nagar","Tarn Taran"];
   $(function() {
  var options = '';
  for (var i = 0; i < punjab.length; i++) {
      options += '<option value="' + punjab[i] + '">' + napunjabgaland[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  if ($val=='Rajasthan') {
    var rajasthan = ["Ajmer","Banswara","Barmer","Barmer Rail Station","Basni","Beawar","Bharatpur","Bhilwara","Bhiwadi","Bikaner","Bongaigaon","Boranada, Jodhpur","Chittaurgarh","Fazilka","Ganganagar","Jaipur","Jaipur-Kanakpura",
                                       "Jaipur-Sitapura","Jaisalmer","Jodhpur","Jodhpur-Bhagat Ki Kothi","Jodhpur-Thar","Kardhan","Kota","Munabao Rail Station","Nagaur","Rajsamand","Sawaimadhopur","Shahdol","Shimoga","Tonk","Udaipur"];
   $(function() {
  var options = '';
  for (var i = 0; i < rajasthan.length; i++) {
      options += '<option value="' + rajasthan[i] + '">' + rajasthan[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  if ($val=='Sikkim') {
    var sikkim = ["Chamurci","Gangtok"];
   $(function() {
  var options = '';
  for (var i = 0; i < sikkim.length; i++) {
      options += '<option value="' + sikkim[i] + '">' + sikkim[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  
  if ($val=='Tamil Nadu') {
    var tn = ["Ariyalur","Chennai","Coimbatore","Cuddalore","Dharmapuri","Dindigul","Erode","Kanchipuram","Kanyakumari","Karur","Krishnagiri","Madurai","Mandapam","Nagapattinam","Nilgiris","Namakkal","Perambalur","Pudukkottai","Ramanathapuram","Salem","Sivaganga","Thanjavur","Thiruvallur","Tirupur",
                                   "Tiruchirapalli","Theni","Tirunelveli","Thanjavur","Thoothukudi","Tiruvallur","Tiruvannamalai","Vellore","Villupuram","Viruthunagar"];
   $(function() {
  var options = '';
  for (var i = 0; i < tn.length; i++) {
      options += '<option value="' + tn[i] + '">' + tn[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  
  if ($val=='Telangana') {
    var telangana = ["Adilabad","Hyderabad","Karimnagar","Mahbubnagar","Medak","Nalgonda","Nizamabad","Ranga Reddy","Warangal"];
   $(function() {
  var options = '';
  for (var i = 0; i < telangana.length; i++) {
      options += '<option value="' + telangana[i] + '">' + telangana[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  
  if ($val=='Tripura') {
    var tripura = ["Agartala","Dhalaighat","Kailashahar","Kamalpur","Kanchanpur","Kel Sahar Subdivision","Khowai","Khowaighat","Mahurighat","Old Raghna Bazar","Sabroom","Srimantapur"];
   $(function() {
  var options = '';
  for (var i = 0; i < tripura.length; i++) {
      options += '<option value="' + tripura[i] + '">' + tripura[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  
  if ($val=='Uttar Pradesh') {
    var up = ["Agra","Allahabad","Auraiya","Banbasa","Bareilly","Berhni","Bhadohi","Dadri","Dharchula","Gandhar","Gauriphanta","Ghaziabad","Gorakhpur","Gunji",
                                    "Jarwa","Jhulaghat (Pithoragarh)","Kanpur","Katarniyaghat","Khunwa","Loni","Lucknow","Meerut","Moradabad","Muzaffarnagar","Nepalgunj Road","Pakwara (Moradabad)",
                                    "Pantnagar","Saharanpur","Sonauli","Surajpur","Tikonia","Varanasi"];
   $(function() {
  var options = '';
  for (var i = 0; i < up.length; i++) {
      options += '<option value="' + up[i] + '">' + up[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  
  if ($val=='Uttarakhand') {
    var uttarakhand = ["Almora","Badrinath","Bangla","Barkot","Bazpur","Chamoli","Chopra","Dehra Dun","Dwarahat","Garhwal","Haldwani","Hardwar","Haridwar","Jamal","Jwalapur","Kalsi","Kashipur","Mall",
                                           "Mussoorie","Nahar","Naini","Pantnagar","Pauri","Pithoragarh","Rameshwar","Rishikesh","Rohni","Roorkee","Sama","Saur"];
   $(function() {
  var options = '';
  for (var i = 0; i < uttarakhand.length; i++) {
      options += '<option value="' + uttarakhand[i] + '">' + uttarakhand[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
  
  if ($val=='West Bengal') {
    var wb = ["Alipurduar","Bankura","Bardhaman","Birbhum","Cooch Behar","Dakshin Dinajpur","Darjeeling","Hooghly","Howrah",
                                    "Jalpaiguri","Kolkata","Maldah","Murshidabad","Nadia","North 24 Parganas","Paschim Medinipur","Purba Medinipur","Purulia","South 24 Parganas","Uttar Dinajpur"];
   $(function() {
  var options = '';
  for (var i = 0; i < wb.length; i++) {
      options += '<option value="' + wb[i] + '">' + wb[i] + '</option>';
  }
  $('#district').html(options);
  });
  }
  
}
</script>
<div class="container-fluid" id="pcont">
    <div class="page-head" id="showlinks">
				<ol class="breadcrumb">
				 <li><a href="home.php">Home</a></li>
                 <li><a href="#"> Students MGT</a></li>
                 <li><a href="students.php">Students Listing</a></li>
				  <li class="active">Student Form</li>
				</ol>
                <div style="float:right;"></div>
			</div>
           
    <div class="cl-mcont">
			<div class="row">
              <form class="form-horizontal group-border-dashed" parsley-validate novalidate action="students.php" id="form_admin" enctype="multipart/form-data" name="form_admin" method="post" style="border-radius: 0px;" ><!--onsubmit="return validate();"-->
              
              <div class="col-md-12">
					<div class="block-flat">
					   

   <table width="100%" border="0" cellspacing="0" cellpadding="0" class="ordrtablelist" >
   <!--------ROSE----------->
   <tr><td width="19%" align="left" valign="top">Title</td>
    <td width="25%" align="left" valign="top">
   
    <div id="divNameTitle">
    <?php  
	$title_list=getResultArray("SELECT * FROM ".NAME_TITLE_TBL." WHERE status = 1  ORDER BY name_title_ID asc ");?>
   <select name="name_title" id="name_title" class="form-control" style="width:85%" >
      <option value="">--Select Title--</option>
                     <?php 
					
				 foreach($title_list as $title){ 
				  ?>
				  <option value="<?php echo $title['name_title_ID'];?>" <?php if($title['name_title_ID']==$name_title){echo 'selected="selected"';} ?> ><?php echo $title['name']; ?></option>
				     <?php } ?>
    </select></div><button type="button" class="close" onclick="displayquestion('main_divNameTitle')"  style="margin-top:-30px;"><i class="fa fa-plus-circle" style="font-size:26px;"></i></button><br />
    <div class="questionholder" id="main_divNameTitle" style="display:none">
       
        <input name="title_field" id="title_field"  class="form-control">
        <br>
       <span class="badge badge-info" onclick="add('name_title','divNameTitle','../ajax/add_field.php')" style="cursor:pointer;">Add</span>
    </div>
    </td>
    <td align="left" valign="top">Upload Profile</td><td align="left" valign="top"> <input type="file" name="file" multiple id="FilUploader" class="form-control" >
 
  <?php if($profile_image != ""){ ?>
				<img src="../uploads/profile/<?php echo $profile_image;?>" style="width:50px; height:50px;">
                 <input type="hidden" name="old_file" value="<?php echo $profile_image;?>"  />
                <?php
				}
				else{?>
                <img src="images/no_profile_image.jpg" style="width:50px; height:50px;">
                <?php
				}?></td>
    </tr>
   
     <tr>
    <td width="19%" align="left" valign="top">Name</td>
    <td width="25%" align="left" valign="top"><input id="name" class="form-control" name="name" required title="Name" value="<?php echo $name; ?>" type="text"></td>
    <td width="27%" align="left" valign="top">Baptismal Name</td>
    <td width="29%" align="left" valign="top"><input id="baptism_name" class="form-control" name="baptism_name" required title="Baptism Name" value="<?php echo $baptism_name; ?>" type="text"></td>
     </tr>
  <tr>
    <td align="left" valign="top">Nick name</td>
    <td align="left" valign="top"><input id="nick_name" class="form-control" name="nick_name" required title="Nick Name" value="<?php echo $nick_name; ?>" type="text"></td>
    <td align="left" valign="top">Surname</td>
    <td align="left" valign="top"><input id="surname" class="form-control parsley-validated" name="surname" required title="Name" value="<?php echo $surname;?>" type="text"></td>
  </tr>
  <tr>
    <td align="left" valign="top">School   </td>
    <td align="left" valign="top"><input name="school" type="text"  class="form-control" id="school" title="School Name" value="<?php echo $school;?>" ></td>
    <td align="left" valign="top">Age</td>
    <td align="left" valign="top"><input id="age" class="form-control parsley-validated" name="age" required title="Age" value="<?php echo $age;?>" type="text"></td>
  </tr>
  <tr>
    <td align="left" valign="top">Class</td>
    <td align="left" valign="top"><div id="divClass"><select name="class"  id="class" class="form-control" style="width:85%" >
     <option value="">--Select Class--</option>
                     <?php $class_list=getResultArray("SELECT * FROM ".CLASS_TBL." WHERE status = 1  ORDER BY class_ID asc ");
				 foreach($class_list as $row){
				  ?>
				  <option value="<?php echo $row['class_ID'] ;?>" <?php echo (($row['class_ID']==$class)?'selected="selected"':'') ?> ><?php echo $row['name']; ?></option>
				     <?php } ?>
    </select></div><button type="button" class="close" onclick="displayquestion('main_divClass')"  style="margin-top:-30px;"><i class="fa fa-plus-circle" style="font-size:26px;"></i></button>
    <div class="questionholder" id="main_divClass" style="display:none">
        <input name="class_name" id="class_name"  class="form-control"><br>
       <span class="badge badge-info" onclick="add('class','divClass','../ajax/add_field.php')" style="cursor:pointer;">Add</span>
    </div>
     
    </td>
    <td align="left" valign="top">Parish</td>
    <td align="left" valign="top"> <div id="divParish"><select name="parish_id" id="parish_id" class="form-control"  onchange="display_input('../ajax/parish_teacher_select.php','divParishTeacher_select', this.value)" style="width:85%;" >
                  <option value="">--Select Parish--</option>
                     <?php 
					  $parish_arr=getResultArray("SELECT parish_ID, name FROM ".MTABLE."parish WHERE parish_status = 1  ORDER BY parish_ID asc "); 
				 foreach($parish_arr as $row){
				  ?>
				  <option value="<?php echo $row['parish_ID'] ;?>" <?php echo (($row['parish_ID']==$parish_id)?'selected="selected"':'') ?> ><?php echo $row['name']; ?></option>
				     <?php } ?>
                  </select></div><button type="button" class="close" onclick="displayquestion('main_divParish')"  style="margin-top:-30px;"><i class="fa fa-plus-circle" style="font-size:26px;"></i></button><br />
                  <div class="questionholder" id="main_divParish" style="display:none">
       <table><tr><td> Name</td>
       <td>        <input name="parish_field" id="parish_field" class="form-control"></td></tr>
       <tr><td>Vicari</td><td><input name="parish_vicari" id="parish_vicari" class="form-control" /></td></tr>
        <tr><td>Phone No.</td><td><input name="parish_phone" id="parish_phone" class="form-control"/></td></tr>
          <tr><td>Vicari Address</td><td><input name="vicari_address" id="vicari_address" class="form-control"/></td></tr>
      <tr><td colspan="2"> <span class="badge badge-info" onclick="add_array('parish', 'divParish','../ajax/add_number_of_fields.php')" style="cursor:pointer;">Add</span>
   </td></tr></table> </div>
                 </td>
  </tr>
 
  <tr>
    <td align="left" valign="top">Sunday School Place</td>
    <td align="left" valign="top"><input id="place" class="form-control " name="place"  title="Place" value="<?php echo $place; ?>" type="text"></td>
    <td align="left" valign="top">Diocese </td>
    <td align="left" valign="top"><div id="divDiocese"><select name="diocese_id" id="diocese_id" class="form-control" onchange="display_input('../ajax/parish_select.php','divParish_select',this.value)" style="width:85%;"   >
                  <option value="">--Select Diocese--</option>
                     <?php 
					  list($diocese_id)=$db->fetch_one_row("SELECT diocese_ID FROM ".MTABLE."parish  WHERE parish_ID='".$parish_id."'");
					
					  $diocese_arr=getResultArray("SELECT * FROM ".MTABLE."diocese WHERE diocese_status = 1  ORDER BY diocese_ID asc "); 
				 foreach($diocese_arr as $row){
				  ?>
				  <option value="<?php echo $row['diocese_ID'] ;?>" <?php echo (($row['diocese_ID']==$diocese_id)?'selected="selected"':'') ?> ><?php echo $row['diocese_name']; ?></option>
				     <?php } ?>
                  </select></div><button type="button" class="close"  onclick="displayquestion('main_divDiocese')" style="margin-top:-30px;"><i class="fa fa-plus-circle" style="font-size:26px;"></i></button>
                  <br />
                   <div class="questionholder" id="main_divDiocese" style="display:none">
        Name<br>
        <input name="diocese_field" id="diocese_field"  class="form-control"><br>
       <span class="badge badge-info" onclick="add('diocese_add','divDiocese','../ajax/add_field.php')" style="cursor:pointer;">Add</span>
    </div>
                  </td>
  </tr>

  <tr>
    <td align="left" valign="top">Forane	</td>
    <td align="left" valign="top"><input id="forane" class="form-control parsley-validated" name="forane"  title="Forane" value="<?php echo $forane;?>" type="text"></td>
    <td align="left" valign="top">Place</td>
    <td align="left" valign="top"><input id="place" class="form-control parsley-validated" name="place"  title="Place" value="<?php echo $place; ?>" type="text"></td>
  </tr>
  <tr>
    <td align="left" valign="top">DOB</td>
    <td align="left" valign="top"> <div class="input-group date form_date " data-date-format="dd-mm-yyyy" data-link-field="dtp_input1" >
    <input id="dob" class="form-control" name="dob"  title="DoB" value="<?php if($dob != '') { echo date('d-m-Y',$dob); } ?>" type="text">
    <span class="input-group-addon btn btn-primary"><span class="glyphicon glyphicon-th"></span></span></div></td>
    <td align="left" valign="top">Altar Boy   </td>
    <td align="left" valign="top"><label> <input type="radio" value="1" name="altara_boy" <?php if($altara_boy=='1'){ echo 'checked="checked"';}?>> Yes </label><label> <input type="radio" value="0"  name="altara_boy"  <?php if($altara_boy=='0' || $altara_boy='' ){ echo 'checked="checked"';}?> > No</label></td>
  </tr>
  <tr>
    <td align="left" valign="top">Which class onwards</td>
    <td align="left" valign="top"><input id="from_class" class="form-control parsley-validated" name="from_class"  title="Class"  type="text" value="<?php echo $from_class;?>"></td>
    <td align="left" valign="top">Catechism Class</td>
    <td align="left" valign="top"><input id="catechism_class" class="form-control parsley-validated"  name="catechism_class"  title="Name"  type="text"  value="<?php echo$catechism_class;?>"></td>
  </tr>
  <tr>  <td align="left" valign="top">First Memory</td>
    <td align="left" valign="top"><input id="first_memory" class="form-control parsley-validated" name="first_memory"  title="First Memory"  type="text"  value="<?php echo $first_memory;?>"></td></tr>
    
      
</table>

<!-----------Father mother details------>

<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ordrtablelist">
      <tr>
        <td>Father&rsquo;s Name   </td>
        <td><input id="father_name" class="form-control" name="father_name"  title="Father" value="<?php echo $father_name; ?>" type="text"></td>
        <td>Calling Name</td>
        <td><input id="father_nickname" class="form-control" name="father_nickname"  title="Father Nickname" value="<?php echo $father_nickname; ?>" type="text"></td>
        <td>Occupation</td>
        <td><input id="father_occupation" class="form-control" name="father_occupation"  title="Father Occupation" value="<?php echo $father_occupation; ?>" type="text"></td>
      </tr>
      <tr>
        <td>Mother&rsquo;s Name </td>
        <td><input id="mother_name" class="form-control" name="mother_name"  title="Mother" value="<?php echo $mother_name; ?>" type="text"></td>
        <td>Calling Name</td>
        <td><input id="mother_nickname" class="form-control" name="mother_nickname"  title="Mother Nickname" value="<?php echo $mother_nickname; ?>" type="text"></td>
        <td>Occupation</td>
        <td><input id="mother_occupation" class="form-control" name="mother_occupation"  title="Mother Occupation" value="<?php echo $mother_occupation; ?>" type="text"></td>
      </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="ordrtablelist">
      <tr>
        <td>Land Phone   </td>
        <td><input id="land_phone" class="form-control" name="land_phone"  title="Land Phone" value="<?php echo $land_phone; ?>" type="text"></td>
        <td>Cell</td>
        <td><input id="cell_phone" class="form-control" name="cell_phone"  title="Cell Phone" value="<?php echo $land_phone; ?>" type="text" placeholder="Personal"></td>
        
      </tr>
      <tr>
      <td>Father&rsquo;s Mobile</td>
        <td><input id="father_mobile" class="form-control" name="father_mobile"  title="Father Mobile" value="<?php echo $father_mobile; ?>" type="text" ></td>
        <td>Mother&rsquo;s Phone </td>
        <td><input id="mother_mobile" class="form-control" name="mother_mobile"  title="Mother Phone" value="<?php echo $mother_mobile; ?>" type="text" ></td>
       
      </tr>
    </table>
    <!-------------------end Phone numbers----------------------->
    <table width="100%" border="0" cellspacing="0" cellpadding="0" class="ordrtablelist">
  <tr>
    <td>Siblings ( Eldest to the youngest order)<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tlist" >
  <tr>
    <td width="34%">Name</td>
    <td width="10%">Age</td>
    <td width="35%">Education</td>
    <td width="21%">Status</td>
  </tr>
  <?php 
  $count_input=0;
 if($action=='update'){
	 if(!empty($siblings_arr)){ 
		 $i=1;
		  $existing_sibling=count($siblings_arr);
		 foreach($siblings_arr as $row){ ?>
          <tr>
    <td><input id="sibling_name_<?php echo $i;?>" class="form-control" name="sibling_name_<?php echo $i;?>"  title="Name"  type="text" value="<?php echo $row['relation_name'];?>"></td>
    <td><input id="age_<?php echo $i;?>" class="form-control" name="age_<?php echo $i;?>"  title="Age"  type="text" value="<?php echo $row['relation_age'];?>"></td>
    <td><input id="education_<?php echo $i;?>" class="form-control" name="education_<?php echo $i;?>" value="<?php echo $row['relation_education'];?>" title="Name"  type="text"></td>
    <td><select name="relation_with_student<?php echo $i;?>" id="relation_with_student<?php echo $i;?>" class="form-control" >
                  <option value="">--Select Relation--</option>
                 <option value="brother" <?php if($row['relation_with_student'] =='brother'){ echo 'selected="selected"';}?>>Brother</option>
                 <option value="sister" <?php if($row['relation_with_student'] =='sister'){ echo 'selected="selected"';}?>>Sister</option>
                  </select></td>
  </tr>
         <?php
		 $i++;
		 $count_input=$i;
		 }// foreach
		 if($count_input < 5){
			 $sibling_no=5- $count_input;
			  for($i=$count_input;$i<=$siblings_no;$i++){?>
			  <tr>
    <td><input id="sibling_name_<?php echo $i;?>" class="form-control" name="sibling_name_<?php echo $i;?>"  title="Name"  type="text"></td>
    <td><input id="age_<?php echo $i;?>" class="form-control" name="age_<?php echo $i;?>"  title="Age"  type="text"></td>
    <td><input id="education_<?php echo $i;?>" class="form-control" name="education_<?php echo $i;?>"  title="Name"  type="text"></td>
    <td><select name="relation_with_student<?php echo $i;?>" id="relation_with_student<?php echo $i;?>" class="form-control" >
                  <option value="">--Select Relation--</option>
                 <option value="brother">Brother</option>
                 <option value="sister">Sister</option>
                  </select></td>
  </tr>
         <?php
		 $i++;
			 }// for close
		 }// condition count input
	 }// not empty close
	 else{ $existing_sibling=0;
		$siblings_no=5;
		
  for($i=1;$i<=$siblings_no;$i++){?>
          <tr>
    <td><input id="sibling_name_<?php echo $i;?>" class="form-control" name="sibling_name_<?php echo $i;?>"  title="Name"  type="text"></td>
    <td><input id="age_<?php echo $i;?>" class="form-control" name="age_<?php echo $i;?>"  title="Age"  type="text"></td>
    <td><input id="education_<?php echo $i;?>" class="form-control" name="education_<?php echo $i;?>"  title="Name"  type="text"></td>
    <td><select name="relation_with_student<?php echo $i;?>" id="relation_with_student<?php echo $i;?>" class="form-control" >
                  <option value="">--Select Relation--</option>
                 <option value="brother">Brother</option>
                 <option value="sister">Sister</option>
                  </select></td>
  </tr>
         <?php
		 $i++;
		 $count_input=$i;
		 }
		 
		 }
 }?>
  <input type="hidden" name="siblings_no" value="5" />
</table></td>
  </tr>
</table> 
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="ordrtablelist" >
<?php

$subject_array=array('0'=>'English', '1'=>'Malayalam I', '2'=>'Malayalam II', '3'=>'Hindi','4'=>'GK', '5'=>'Social Science','6'=>'Physics', '7'=>'Chemistry', '8'=>'Biology', '9'=>'Mathematics','10'=>'IT', '11'=>'Catechism');

?>
  
  <tr>
    <td colspan="4" align="left" valign="top">Marks received at finally attended term exam ( Subject with  total marks)
      <div class="input-group date form_date" data-date-format="dd-mm-yyyy" data-link-field="dtp_input1" style="width:200px;">
    <input id="final_exam_date" class="form-control" name="final_exam_date"  title="Date" value="<?php if($final_exam_date != '') { echo $final_exam_date; } ?>" type="text">
    <span class="input-group-addon btn btn-primary "><span class="glyphicon glyphicon-th"></span></span></div>
     <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tlist" >
        <?php 
		
		
if($action=='update'){  

if($final_exam_id !='')
//print_r("SELECT * FROM ".EXAM_RESULT_TBL." WHERE exam_ID = ".$final_exam_id."  ORDER BY result_ID asc ");
	$final_exam_result_array=getResultArray("SELECT * FROM ".EXAM_RESULT_TBL." WHERE exam_ID = ".$final_exam_id."  ORDER BY result_ID asc ");
	?>
    <input type="hidden" name="final_exam_id" value="<?php echo $final_exam_id;?>" />
    <?php
	$end_count2=0;
	if(!empty($final_exam_result_array)){
		$i=0;
		$count=1;
		$grand_total_marks=0;
		$grand_outof=0;
		foreach($final_exam_result_array as $r){ 
			if($count=='1'){
				echo '<tr>';
			}
			
			?>
        <td><?php echo $subject_array[$i];?><br /> <input id="final_subjects_<?php echo $i;?>" class="form-control" name="final_subjects_<?php echo $i;?>"  title="Subjects" value="<?php echo $r['subjects'];?>"  type="hidden">
    <input id="final_marks_<?php echo $i;?>" class="form-control"  name="final_marks_<?php echo $i;?>"  title="Marks"  type="text"  value="<?php echo $r['marks'];?>"  style="width:25%; float:left; margin-right:10px;"  placeholder="Marks" >
    <input id="final_outof_<?php echo $i;?>" class="form-control"  name="final_outof_<?php echo $i;?>"  title="Out of"  type="text"   style="width:25%; float:left; margin-right:10px;" value="<?php echo $r['outof'];?>"  placeholder="Out of" >
  <div id="divPercentage_final_<?php echo $i;?>"><a  onclick="return percentage_calculation('final','<?php echo $i;?>');"  style="width:25%; float:left; margin-right:10px;">Click for %  </a>
    </td>
        
        <?php
		$grand_total_marks=$r['marks']+$grand_total_marks;
		$grand_outof=$r['outof']+$grand_outof;
		$i++;
		$count++;
		
		if($count>'4'){ echo '</tr>'; $count=1; }
		}
		$end_count2=$i;
	}
	
		
		for($s=$end_count2; $s<count($subject_array) ; $s++){
			if($count=='1'){
				echo '<tr>';
			}
			?>
    <td><?php echo $subject_array[$s];?> <br /><input id="final_subjects_<?php echo $s;?>" class="form-control" name="final_subjects_<?php echo $s;?>"   title="Subjects" value="<?php echo $subject_array[$s];?>"  type="hidden">
    <input id="final_marks_<?php echo $s;?>" class="form-control"  name="final_marks_<?php echo $s;?>"  title="Marks"  type="text"  style="width:25%; float:left; margin-right:10px;"  placeholder="Marks "  >
    <input id="final_outof_<?php echo $s;?>" class="form-control"  name="final_outof_<?php echo $s;?>"  title="Out of"  type="text"   style="width:25%; float:left; margin-right:10px;"  placeholder="Out of">
  <div id="divPercentage_final_<?php echo $s;?>"  style="width:25%; float:left; margin-right:10px;"><a  onclick="return percentage_calculation('final','<?php echo $s;?>');">Click for %  </a>
    </td>
   
    <?php
	$count++;
		if($count >'4'){ echo '</tr>'; $count=1;}
		}// for
		
		
}//not update
else{
		$count=1;
		for($s=0; $s<count($subject_array) ; $s++){
			if($count=='1'){
				echo '<tr>';
			}
			?>
    <td><?php echo $subject_array[$s];?> <br /><input id="final_subjects_<?php echo $s;?>" class="form-control" name="final_subjects_<?php echo $s;?>"  title="Subjects" value="<?php echo $subject_array[$s];?>"  type="hidden">
    <input id="final_marks_<?php echo $s;?>" class="form-control"  name="final_marks_<?php echo $s;?>"  title="Marks"  type="text"  style="width:25%; float:left; margin-right:10px;"  placeholder="Marks " >
    <input id="final_outof_<?php echo $s;?>" class="form-control"  name="final_outof_<?php echo $s;?>"  title="Out of"  type="text"   style="width:25%; float:left; margin-right:10px;"  placeholder="Out of">
  <div id="divPercentage_final_<?php echo $s;?>"  style="width:25%; float:left; margin-right:10px;"><a  onclick="return percentage_calculation('final','<?php echo $s;?>');">Click for Show %  </a>
    </td>
    <?php
	
		$count++;
		if($count=='5'){ echo '</tr>'; $count=1;}
		}// for
}
		?>
 <tr><td colspan="2" align="left">Grand Total</td><td colspan="2" align="left"><?php echo $grand_total_marks." Out of ".$grand_outof;?></td></tr>
</table></td>
    </tr>
 <?php   
    
    $questions_section_array=getResultArray("SELECT * FROM ".QUES_ANS_TBL." WHERE status = 1    AND question_type_ID='4' ORDER BY question_answer_ID asc ");
foreach($questions_section_array as $sec2){  ?>
	<tr>
   <td align="left"  colspan="2" valign="top"><?php echo $sec2['questions'];?></td><td colspan="2"> 
   <?php if($action=='update'){
    $student_answer_array=getResultArray("SELECT * FROM ".STUDENT_ANSWER_TBL." WHERE student_ID = ".$select_id."  AND question_answer_ID= ".$sec2['question_answer_ID']);
	if(!empty($student_answer_array)){
		  foreach($student_answer_array as $ans){ 
			  if($sec2['question_answer_ID']==$ans['question_answer_ID']){
				   if($sec2['question_struct']=='checkbox'){//print_r(" CHECKED");
					     $checkbox_values_array=getResultArray("SELECT * FROM ".CHECKBOX_TBL." WHERE question_answer_ID = ".$sec2['question_answer_ID']." ORDER BY checkbox_values_ID asc ");
							$count=1;
						  foreach($checkbox_values_array as $values){ // print_r($values);
						  if($values['checkbox_values_ID']==$ans['answers']){
							  $checked='checked="checked"';
						  }
						  else{
							  $checked='';
							  }
							  
				   ?>
                   <input type="checkbox" name="checkbox_<?php echo $sec2['question_answer_ID'];?>_<?php echo $values['checkbox_values_ID'];?>"  id="checkbox_<?php echo $sec2['question_answer_ID'];?>_<?php echo $values['checkbox_values_ID'];?>"  <?php echo $checked;?>>&nbsp;<?php echo  $values['checkbox_fields'];?>&nbsp;&nbsp;&nbsp;
          <?php
		  			$count++;
					
						  }// checkbox values loop 
				   }// checkbox close
				    if($sec2['question_struct']=='radio'){
						if($ans['answers']=='1'){
							 $yes='checked="checked"';
							  $no='';
						}
						else{
							$no='checked="checked"';
							  $yes='';
							}
						?>
                    <input type="radio" name="radio_<?php echo $sec2['question_answer_ID'];?>" id="radio_<?php echo $sec2['question_answer_ID'];?>" value="1" <?php echo $yes;?>> Yes &nbsp;&nbsp; <input type="radio" name="radio_<?php echo $sec2['question_answer_ID'];?>" id="radio_<?php echo $sec2['question_answer_ID'];?>" value="0" <?php echo $no;?> > No
                    <?php
					}//radio close
					 if($sec2['question_struct']=='textbox'){?>
                     <input id="answer_<?php echo $sec2['question_answer_ID'];?>" class="form-control" name="answer_<?php echo $sec2['question_answer_ID'];?>"  value="<?php echo $ans['answers'];?>"   type="text">	
                     <?php
					 }// text box close
			  }// question answer Id close
			  else{
				   if($sec2['question_struct']=='checkbox'){ print_r("NOT CHECKED");
					     $checkbox_values_array=getResultArray("SELECT * FROM ".CHECKBOX_TBL." WHERE question_answer_ID = ".$sec2['question_answer_ID']." ORDER BY checkbox_values_ID asc ");
						 foreach($checkbox_values_array as $values){  
					   ?>
                   <input type="checkbox" name="checkbox_<?php echo $sec2['question_answer_ID'];?>_<?php echo $values['checkbox_values_ID'];?>"  id="checkbox_<?php echo $sec2['question_answer_ID'];?>_<?php echo $values['checkbox_values_ID'];?>" >&nbsp;<?php echo  $values['checkbox_fields'];?>&nbsp;&nbsp;&nbsp;
                   <?php
						 }//checkbox values loop close
				   }//check box close
				    if($sec2['question_struct']=='radio'){?>
						<input type="radio" name="radio_<?php echo $sec2['question_answer_ID'];?>" id="radio_<?php echo $sec2['question_answer_ID'];?>" value="1"> Yes &nbsp;&nbsp; <input type="radio" name="radio_<?php echo $sec2['question_answer_ID'];?>" id="radio_<?php echo $sec2['question_answer_ID'];?>" value="0"> No
					<?php }
					 if($sec2['question_struct']=='textbox'){?>
						 <input id="answer_<?php echo $sec2['question_answer_ID'];?>" class="form-control" name="answer_<?php echo $sec2['question_answer_ID'];?>"    type="text" >
					<?php }
				  
				  }// question answer id else close
		  }// foreach student answer array
	}// not empty student answer array
	else{// not empty student answer array else
	
		  if($sec2['question_struct']=='checkbox'){
			   $checkbox_values_array=getResultArray("SELECT * FROM ".CHECKBOX_TBL." WHERE question_answer_ID = ".$sec2['question_answer_ID']." ORDER BY checkbox_values_ID asc ");
						 foreach($checkbox_values_array as $values){  
			  ?>
                   <input type="checkbox" name="checkbox_<?php echo $sec2['question_answer_ID'];?>_<?php echo $values['checkbox_values_ID'];?>"  id="checkbox_<?php echo $sec2['question_answer_ID'];?>_<?php echo $values['checkbox_values_ID'];?>"  />&nbsp;<?php echo  $values['checkbox_fields'];?>&nbsp;&nbsp;&nbsp;
                   <?php
						 }
				   }
				    if($sec2['question_struct']=='radio'){?>
						<input type="radio" name="radio_<?php echo $sec2['question_answer_ID'];?>" id="radio_<?php echo $sec2['question_answer_ID'];?>" value="1"> Yes &nbsp;&nbsp; <input type="radio" name="radio_<?php echo $sec2['question_answer_ID'];?>" id="radio_<?php echo $sec2['question_answer_ID'];?>" value="0"> No
					<?php }
					 if($sec2['question_struct']=='textbox'){?>
						 <input id="answer_<?php echo $sec2['question_answer_ID'];?>" class="form-control" name="answer_<?php echo $sec2['question_answer_ID'];?>"    type="text" >
					<?php }
		
		}// not empty student answer array else close
		
   }
   else{// update else
	     if($sec2['question_struct']=='checkbox'){
			   $checkbox_values_array=getResultArray("SELECT * FROM ".CHECKBOX_TBL." WHERE question_answer_ID = ".$sec2['question_answer_ID']." ORDER BY checkbox_values_ID asc ");
						 foreach($checkbox_values_array as $values){  
			  ?>
                   <input type="checkbox" name="checkbox_<?php echo $sec2['question_answer_ID'];?>_<?php echo $values['checkbox_values_ID'];?>"  id="checkbox_<?php echo $sec2['question_answer_ID'];?>_<?php echo $values['checkbox_values_ID'];?>"  />&nbsp;<?php echo  $values['checkbox_fields'];?>&nbsp;&nbsp;&nbsp;
                   <?php
						 }
				   }
				    if($sec2['question_struct']=='radio'){?>
						<input type="radio" name="radio_<?php echo $sec2['question_answer_ID'];?>" id="radio_<?php echo $sec2['question_answer_ID'];?>" value="1"> Yes &nbsp;&nbsp; <input type="radio" name="radio_<?php echo $sec2['question_answer_ID'];?>" id="radio_<?php echo $sec2['question_answer_ID'];?>" value="0"> No
					<?php }
					 if($sec2['question_struct']=='textbox'){?>
						 <input id="answer_<?php echo $sec2['question_answer_ID'];?>" class="form-control" name="answer_<?php echo $sec2['question_answer_ID'];?>"    type="text" >
					<?php }
	   
	   }// not update close?></td>
	
<?php }//  question setion array
?>
  
  
    <tr>
    <td colspan="4" align="left" valign="top">Schools Attended <br>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tlist" >
<?php $sch_arr=array('0'=>'L.P', 1=> 'U.P', 2=>'H.S', 3=>'H.S.S', 4=>'Degree');

?>
  <tr>
    <td>School</td>
    <td>Syllabus</td>
    <td>Place</td>
    </tr>
    <?php 
	if($action=='update'){
		$co=0;
	 	if(!empty($previous_school_arr)){
			$co=0;
			$su=0;
			foreach($previous_school_arr as $prev){?>
        
         <tr>
    <td><?php echo $sch_arr[$co];?>
    <input type="hidden" name="prev_title[]" value="<?php echo $sch_arr[$co];?>" />
    <input type="text" name="previous_school_name[]"  id="previous_school_name" value="<?php echo $prev['previous_school_name'];?>" class="form-control"/ ></td>
    <td><input type="text" name="previous_syllabus[]"  id="previous_syllabus" class="form-control" value="<?php echo $prev['previous_syllabus'];?>"/></td>
    <td><input type="text" name="previous_school_place[]"  id="previous_school_place"  value="<?php echo $prev['previous_school_place'];?>"class="form-control"/></td>
    </tr>
        
<?php $co++;

			
			}//foreach
			if($co< count($sch_arr)){
				for($j=$co; $j<count($sch_arr) ; $j++){?>
                 <tr>
		<td><?php echo $sch_arr[$j];?>
         <input type="hidden" name="prev_title" value="<?php echo $sch_arr[$j];?>" />
         <input type="text" name="previous_school_name[]"  id="previous_school" class="form-control"/ ></td>
		<td><input type="text" name="previous_syllabus[]"  id="previous_syllabus" class="form-control"/></td>
		<td><input type="text" name="previous_school_place[]"  id="previous_school_place" class="form-control"/></td>
		</tr>
        <?php
				}
				
			}
			
		}// not empty previous school
		else{// not empty ELSE open previous school
			
			for($j=$co; $j<count($sch_arr) ; $j++){?>
	  <tr>
		<td><?php echo $sch_arr[$j];?>
         <input type="hidden" name="prev_title" value="<?php echo $sch_arr[$j];?>" />
        <input type="text" name="previous_school_name[]"  id="previous_school"  class="form-control"/ ></td>
		<td><input type="text" name="previous_syllabus[]"  id="previous_syllabus" class="form-control"/></td>
		<td><input type="text" name="previous_school_place[]"  id="previous_school_place" class="form-control"/></td>
		</tr>
		<?php 
			}// end for loop
		}// not empty ELSE CLOSE previous school
	 }//CLOSE UPDATE
	 else{
		 
		 for($c=0; $c<count($sch_arr) ; $c++){?>
	  <tr>
		<td><?php echo $sch_arr[$c];?>
         <input type="hidden" name="prev_title" value="<?php echo $sch_arr[$c];?>" />
        <input type="text" name="previous_school_name[]"  id="previous_school"  class="form-control"/ ></td>
		<td><input type="text" name="previous_syllabus[]"  id="previous_syllabus" class="form-control"/></td>
		<td><input type="text" name="previous_school_place[]"  id="previous_school_place" class="form-control"/></td>
		</tr>
		<?php 
			}// end for loop
		 
		 
		 }// else close?>
         
         
         
         
     
   
         
         
        <table width="100%" border="0" cellspacing="0" cellpadding="0" class="ordrtablelist">  
         
       <tr>
    <td align="left" colspan="2"  valign="top">Personal E-mail</td>
    <td align="left"  valign="top"><input name="email" type="text"  class="form-control" id="email" title="Email" value="<?php echo $email;?>"></td>
    <td align="left" valign="top" colspan="2" >Whatsapp</td>
    <td align="left" valign="top"><input id="whats_up" class="form-control" name="whats_up"  title="Whats Up" value="<?php echo $whats_up;?>" type="text" ></td>
  </tr> 
  
        <tr>
    <td align="left" valign="top" colspan="2" >Facebook</td>
    <td align="left" valign="top"><input id="fb" class="form-control" name="fb"  title="Facebook" value="<?php echo $fb;?>" type="text"></td>
    <td align="left" valign="top" colspan="2" >Instagram</td>
    <td align="left" valign="top"><input id="instagram" class="form-control" name="instagram"  title="Instagram" value="<?php echo $instagram;?>" type="text" ></td>
  </tr> 
   </table>
        <tr>
    <td colspan="4" align="left" valign="top"><table><tr><td  colspan="4" align="left" valign="top">Home Address & Pin code </td></tr>
    
    <tr><td align="left" valign="top">
     House Name</td><td><input id="house_name" class="form-control " name="house_name"  title="House Name" value="<?php echo $house_name; ?>" type="text"></td>
</tr>
<tr>
    <td>Post Box</td>
    <td><input id="post_box" class="form-control" name="post_box"  title="Post Box" value="<?php echo $post_box;?>" type="text" ></td>
  </tr>
  <tr>
    <td>Post office</td>
    <td><input id="post_office" class="form-control" name="post_office"  title="Post Office" value="<?php echo $post_office;?>" type="text"  >
  </tr>
  <tr>
    <td>Pin Code</td>
    <td><input id="post_code" class="form-control" name="post_code"  title="Pin Code" value="<?php echo $post_code;?>" type="text" ></td>
  </tr>
 <tr>
    <td>Country</td>
    <td> <select name="country" id="country" class="form-control"  >
                 
              		
				  <option value="IN" <?php if($country=="IN"){ echo 'selected="selected"';}?> >India</option>
                  </select></td>
  </tr>

  <tr>
    <td>State</td>
    <td><!--<div class="resp_code frms">
      
      <div id="selection">-->
      <?php  
	  	  $state_table_arr=getResultArray("SELECT * FROM ".STATE_TBL."  WHERE country_ID = 1 ORDER BY state_ID asc ");
	  
?>     <select id="state" onChange="selct_district(this.value)" name="state" class="form-control">
     <option value="" >-------Select State--------</option>
     <?php
	
	  foreach($state_table_arr as $row){ 
	 
	 ?>
     <option value="<?php echo $row['state'] ;?>" <?php if($row['state']==$state){echo 'selected="selected"';} ?> ><?php echo $row['state'];?></option>
				     <?php } ?></select>
                     
                    
  </tr>                  
  <tr>
    <td><?php echo $district;?></td>
    <td><select id="district" class="form-control" name="district">
    <option value="">----Select District--</option>
   </select>
  
        
    </td>
  </tr>
    <tr>
    <td colspan="2">Confidential Report of Vicar</td>
    </tr>
   <tr>
    <td colspan="2"><textarea name="vicar_report"  id="title" rows="3"  class="form-control"  placeholder="Vicar report" title="Vicar report"><?php echo $vicar_report;?></textarea></td>
    </tr>
      <tr>
    <td colspan="2">Interview Comments & Result</td>
    </tr>
   <tr>
    <td colspan="2"><textarea name="interview_comments" rows="3"  class="form-control" id="interview_comments" title="Interview Comments"><?php echo $interview_comments;?></textarea></td>
    </tr>
      <tr>
    <td colspan="2">Interviewed By Fathers</td>
    </tr>
   <tr>
    <td colspan="2"><textarea name="interviewed_by" rows="3"  class="form-control" id="interviewed_by" title="Interviewed By"><?php echo $interviewed_by;?></textarea></td>
    </tr>
     <tr> <td colspan="2">Psychological Results</td></tr>
     <tr>
    <td colspan="2"><textarea name="psychological_results" rows="3"  class="form-control" id="psychological_results" placeholder="Psychological_results" title="Psychological_results"><?php echo $psychological_results;?></textarea></td>
    </tr>
      <tr> <td colspan="2">Report of Vicar Promotor</td></tr>
     <tr>
    <td colspan="2"><textarea name="vicar_premotor_report" rows="3"  class="form-control" id="vicar_premotor_report" placeholder="Report of Vicar Promotor" title="Report of vicar Promotor"><?php echo $vicar_premotor_report;?></textarea></td>
    </tr>
    
   <tr><td>Signature</td><td> <input type="file" name="file2"  class="form-control" >
 
  <?php if($signature != ""){ ?>
				<img src="../uploads/signature/<?php echo $signature;?>" style="width:50px; height:50px;">
                 <input type="hidden" name="old_signature" value="<?php echo $signature;?>"  />
                <?php
				}
				else{?>
                <img src="images/nil_image.png" style="width:50px; height:50px;">
                <?php
				}?></td></tr>
                
                 <tr><td>Continue Status</td><td><select name="continue_status" id="continue_status" class="form-control">
                      <option value="">----Select Status----</option>
                      <?php  $continue_status_list=getResultArray("SELECT * FROM ".CONTINUE_TBL." WHERE status = 1  ORDER BY continue_status_ID asc ");  
					  foreach($continue_status_list as $row){?>
                       <option value="<?php echo $row['continue_status_ID'];?>" <?php if($continue_status == $row['continue_status_ID']){?>selected="selected" <?php }?>><?php echo $row['name'];?></option>
                       <?php }?>
                       </select></td></tr>
</table>
    </td>
  </tr>
        <tr>
          <td colspan="4" align="left" valign="top">Exam Results<br>
<div style="width:100%; height:600px;  overflow-y: scroll;">
						<table width="100%" border="0" cellspacing="0" cellpadding="0" class="tablestudentview">
                          <?php 
						  $subject_array=array('0'=>'English', '1'=>'Malayalam I', '2'=>'Malayalam II', '3'=>'Hindi','4'=>'GK', '5'=>'Social Science','6'=>'Physics', '7'=>'Chemistry', '8'=>'Biology', '9'=>'Mathematics','10'=>'IT', '11'=>'Catechism');
						?>
   <tr>
 <input type="hidden" name="no_subjects" value="<?php echo count($subject_array);?>" />
    <td colspan="4" class="headviewbg">ONAM</td>
    
    <input type="hidden"  name="onam_exam_model" value="3" />
    </tr>
    <tr><td><div class="input-group date form_date" data-date-format="dd-mm-yyyy" data-link-field="dtp_input1" style="width:200px;">
    <input id="onam_exam_date" class="form-control" name="onam_exam_date"  title="Date" value="<?php if($onam_exam_date != '') { echo $onam_exam_date; } ?>" type="text">
    <span class="input-group-addon btn btn-primary "><span class="glyphicon glyphicon-th"></span></span></div></td><td>&nbsp;</td>
  <tr>
    <td class="headview">Subject</td>
    <td class="headview">Mark</td>
     <td class="headview">Out of</td>
    <td class="headview">Percentage(%)</td>
    </tr>

<?php
if($action=='update'){  

if($onam_exam_id !=''){
	$onam_exam_result_array=getResultArray("SELECT * FROM ".EXAM_RESULT_TBL." WHERE exam_ID = ".$onam_exam_id."  ORDER BY result_ID asc ");
	?>
    <input type="hidden" name="onam_exam_id" value="<?php echo $onam_exam_id;?>" />
    <?php
	if(!empty($onam_exam_result_array)){
		$i=0;
		foreach($onam_exam_result_array as $r){?>
        <tr>
    <td><?php echo $subject_array[$i];?>
    <input id="onam_subjects_<?php echo $i;?>" class="form-control"  name="onam_subjects_<?php echo $i;?>"  title="Subjects"  type="hidden" style="width:45px;"  value="<?php echo $r['subjects'];?>" >
   </td>
    <td>
    <input id="onam_marks_<?php echo $i;?>" class="form-control"  name="onam_marks_<?php echo $i;?>"  title="Marks"  type="text" style="width:45px;"  value="<?php echo $r['marks'];?>" >
   </td>
    <td><input id="onam_outof_<?php echo $i;?>" class="form-control"  name="onam_outof_<?php echo $i;?>"  title="Out of"  type="text"  style="width:45px;"  value="<?php echo $r['outof'];?>">
   </td>
    <td id="divPercentage_onam_<?php echo $i;?>"><a  onclick="return percentage_calculation('onam','<?php echo $i;?>');">Click here toShow %  </a></td>
  </tr>
        <?php
		$i++;
		$end_count=$i; 
		}// foreach
		
         for($j=$end_count; $j<count($subject_array); $j++){?>
  <tr>
    <td><?php echo $subject_array[$j];?>
    <input id="onam_subjects_<?php echo $i;?>" class="form-control"  name="onam_subjects_<?php echo $j;?>"  title="Subjects"  type="hidden" style="width:65px;"  value="<?php echo $subject_array[$j];?>" >
   </td>
    <td>
    <input id="onam_marks_<?php echo $j;?>" class="form-control"  name="onam_marks_<?php echo $j;?>"  title="Marks"  type="text" style="width:45px;"  >
   </td>
    <td><input id="onam_outof_<?php echo $j;?>" class="form-control"  name="onam_outof_<?php echo $j;?>"  title="Out of"  type="text"  style="width:45px;">
   </td>
    <td  id="divPercentage_onam_<?php echo $j;?>"><a  onclick="return percentage_calculation('onam','<?php echo $j;?>');">Click here toShow %  </a></td>
  </tr>
  <?php }// for
		}// not empty
		
	}// id not qual to
	else{
	 for($i=0; $i<count($subject_array); $i++){?>
  <tr>
    <td><?php echo $subject_array[$i];?>
    <input id="onam_subjects_<?php echo $i;?>" class="form-control"  name="onam_subjects_<?php echo $i;?>"  title="Subjects"  type="hidden" style="width:45px;"  value="<?php echo $subject_array[$i];?>" >
   </td>
    <td>
    <input id="onam_marks_<?php echo $i;?>" class="form-control"  name="onam_marks_<?php echo $i;?>"  title="Marks"  type="text" style="width:45px;"  >
   </td>
    <td><input id="onam_outof_<?php echo $i;?>" class="form-control"  name="onam_outof_<?php echo $i;?>"  title="Out of"  type="text"  style="width:45px;">
   </td>
    <td id="divPercentage_onam_<?php echo $i;?>"><a  onclick="return percentage_calculation('onam','<?php echo $i;?>');">Click here toShow %  </a></td>
  </tr>
  <?php 
	 }}
}// update
else{ 
 for($i=0; $i<count($subject_array); $i++){?>
  <tr>
    <td><?php echo $subject_array[$i];?>
    <input id="onam_subjects_<?php echo $i;?>" class="form-control"  name="onam_subjects_<?php echo $i;?>"  title="Subjects"  type="hidden" style="width:45px;"  value="<?php echo $subject_array[$i];?>" >
   </td>
    <td>
    <input id="onam_marks_<?php echo $i;?>" class="form-control"  name="onam_marks_<?php echo $i;?>"  title="Marks"  type="text" style="width:45px;"  >
   </td>
    <td><input id="onam_outof_<?php echo $i;?>" class="form-control"  name="onam_outof_<?php echo $i;?>"  title="Out of"  type="text"  style="width:45px;">
   </td>
    <td id="divPercentage_onam_<?php echo $i;?>"><a  onclick="return percentage_calculation('onam','<?php echo $i;?>');">Click here toShow %  </a></td>
  </tr>
  <?php }
}?>
   
  <!--     <tr>
    <td colspan="4" class="headviewbg">MODEL EXAM</td>
     <input type="hidden"  name="model_exam_model" value="2" />
    </tr>
  <tr>
    <td class="headview">Subject</td>
    <td class="headview">Mark</td>
    <td class="headview">Out of</td>
    <td class="headview">Percentage(%)</td>
    </tr>

<?php for($i=0; $i<=count($subject_array); $i++){?>
  <tr>
    <td><?php echo $subject_array[$i];?><input type="hidden" name="onam_subject[]" value="<?php echo $subject_array[$i];?>" /></td>
    <td><input type="text" name="model_marks[]" id="model_marks_<?php $model['exam_model_list_ID'];?>_<?php echo $i;?>" class="form-control" /></td>
    <td><input type="text" name="model_outof[]" id="model_outof_<?php $model['exam_model_list_ID'];?>_<?php echo $i;?>" class="form-control" /></td>
    <td>45%</td>
  </tr>
   <?php }
						  ?>-->
   
                        </table>
                      </div></td>
        </tr>
        <tr><td colspan="4" align="left">
         <h3>Medical report</h3>
                   
                   		<table  class="tablestudentview">
  <tr>
    <td>Weight</td>
    <td><input id="weight" class="form-control" name="weight"  title="Weight" value="<?php echo $weight;?>" type="text">  </td>
  </tr>
   <tr>
    <td>Height</td>
    <td><input id="height" class="form-control" name="height"  title="Height" value="<?php echo $height;?>" type="text">  </td>
  </tr>
   <tr>
    <td>Blood Pressure</td>
    <td><input id="blood_pressure" class="form-control" name="blood_pressure"  title="Hobbies" value="<?php echo $blood_pressure;?>" type="text">  </td>
  </tr>
   <tr>
    <td>Diabetis</td>
    <td><input id="diabetes" class="form-control" name="diabetes"  title="Diabetes" value="<?php echo $diabetes;?>" type="text">  </td>
  </tr>
   <tr>
    <td>Blood group</td>
    <td><input id="blood_group" class="form-control" name="blood_group"  title="Blood group" value="<?php echo $blood_group;?>" type="text">  </td>
  </tr>
  
   <tr>
    <td>Hyproblems/Others</td>
    <td> <input id="others" class="form-control" name="others"  title="Hyproblems/Others" value="<?php echo $others;?>" type="text"> </td>
  </tr>
 </td></tr>
  </table>
  
  
  
</table>	
						
					</div>
				</div>
              
              

                     <div class="form-group">
              <div class="col-sm-offset-2 ">
              <?php if($action =='update'){?>
              <input type="hidden" name="father_relation_id" value="<?php echo $father_relation_id;?>" />
              <input type="hidden" name="mother_relation_id" value="<?php echo $mother_relation_id;?>" />
              <input type="hidden" name="guardian_relation_id" value="<?php echo $guardian_relation_id;?>" />
              <input type="hidden" name="exam_id" value="<?php echo $exam_id;?>" />
              <?php
			  }?>
               <input type="hidden" name="select_id"  id="select_id" value="<?php echo $select_id; ?>">
               <input type="hidden" name="doaction" value="<?php echo $action; ?>">
              <button type="submit" class="btn btn-primary">Save</button>
</div></div>
     
						
					</div>				
				</div></form>
			</div>
			
		  </div>
  </div>