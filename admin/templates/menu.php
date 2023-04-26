<div class="cl-sidebar">
			<div class="cl-toggle"><i class="fa fa-bars"></i></div>
			<div class="cl-navblock">
				<ul class="cl-vnavigation">
                <?php 
				$usertype=$_SESSION['usertype'];
					if($usertype == 1) {
					
					 ?>
					<li><a href="home.php"><i class="fa fa-home"></i>Dashboard</a></li>
                    
                    <li><a href="admin.php"><i class="fa fa-user"></i>Super Admin</a></li>
                     <li><a href="admin.php?previlages=1"><i class="fa fa-user"></i>Set Previlages</a></li>
                    
                   <li><a href="#"><i class="fa fa-users"></i>MGT Parish</a>
						<ul class="sub-menu" <?php if($GrpPage == 1) { echo ' style="display: block;"'; } ?>>
                        
							<li><a href="diocese.php">Diocese</a></li>
                            <li><a href="parish.php">Parish</a></li>
                            <!-- <li><a href="courses.php">Courses</a></li>-->
                            <li><a href="teachers.php">Teacher</a></li>
                            
                            </ul>
                            </li>
                     <li><a href="#"><i class="fa fa-users"></i>Select Box</a>
						<ul class="sub-menu" <?php if($GrpPage == 1) { echo ' style="display: block;"'; } ?>>
                        
							<li><a href="student_category.php">Student Category</a></li>
                            <li><a href="family_financial.php">Family Financial Status</a></li>
                             <li><a href="qualities.php">Qualities</a></li>
                            <li><a href="church_going.php">Church Going List</a></li>
                             <li><a href="qualities.php">Qualities</a></li>
                              <li><a href="reputation.php">Reputation List</a></li>
                               <li><a href="education_type.php">Type of Education List</a></li>
                                <li><a href="relation_with_parish.php">Relation with parish List</a></li>
                                <li><a href="study_status.php">Study Status List</a></li>
                                <li><a href="exam_model.php">Exam Model List</a></li>
                                <li><a href="qualities.php">Qualities</a></li>
                            
                            </ul>
                            </li>
                    
                    <li><a href="#"><i class="fa fa-users"></i>Students MGT</a>
						<ul class="sub-menu" <?php if($GrpPage == 3) { echo ' style="display: block;"'; } ?>>
                        
							<li><a href="students.php">Student</a></li>
                            <li><a href="teacher_comments.php">Teacher's Comments</a></li>
                             <li><a href="certificates.php">Upload Certificates</a></li>
                             <li><a href="appointments.php">Appointments</a></li>
                             <li><a href="educations.php">Educations</a></li>
                              <li><a href="exams.php">Exam Results</a></li>
                               <li><a href="publications_n_conferences.php">Publications And Conferences</a></li>
                                <li><a href="confidential_reports.php">Confidential Reports</a></li>
                                 <li><a href="phone_chart.php">Phone Calls</a></li>
						</ul>
					</li>
 <li><a href="#"><i class="fa fa-users"></i> MST Management</a>
						<ul class="sub-menu" <?php if($GrpPage == 2) { echo ' style="display: block;"'; } ?>>
                        <li><a href="other_mst_persons.php">Add Other MST Persons</a></li>
                         <li><a href="school_visits.php">Add School Visits</a></li>
                          <li><a href="special_days.php">Add Special Days</a></li>
                   </ul>
					</li>
                    
                    
                   
                    
                    <li><a href="logout.php" style="border-bottom:none;"><i class="fa fa-power-off"></i>Logout</a></li>
                    
                     <?php } else { ?>
                     
                    <li><a href="home.php"><i class="fa fa-home"></i>Dashboard</a></li>
                    
                    <li><a href="admin.php"><i class="fa fa-user"></i>User Details</a></li>
                    
                   <li><a href="#"><i class="fa fa-users"></i>MGT Parish</a>
						<ul class="sub-menu" <?php if($GrpPage == 1) { echo ' style="display: block;"'; } ?>>
                        
							<li><a href="diocese.php">Diocese</a></li>
                            <li><a href="parish.php">Parish</a></li>
                            <!-- <li><a href="courses.php">Courses</a></li>-->
                            <li><a href="teachers.php">Teacher</a></li>
                            
                            </ul>
                            </li>
                    
                   
                    
                    <li><a href="#"><i class="fa fa-users"></i>Students MGT</a>
						<ul class="sub-menu" <?php if($GrpPage == 3) { echo ' style="display: block;"'; } ?>>
                        
							<li><a href="students.php">Student</a></li>
                            <li><a href="teacher_comments.php">Teacher's Comments</a></li>
                             <li><a href="certificates.php">Upload Certificates</a></li>
                               <li><a href="appointments.php">Appointments</a></li>
                                <li><a href="exams.php">Exam Results</a></li>
                                 <li><a href="publications_n_conferences.php">Publications And Conferences</a></li>
                                   <li><a href="confidential_reports.php">Confidential Reports</a></li>
                                     <li><a href="phone_chart.php">Phone Calls</a></li>
						</ul>
					</li>

                     <li><a href="#"><i class="fa fa-users"></i> MST Management</a>
						<ul class="sub-menu" <?php if($GrpPage == 2) { echo ' style="display: block;"'; } ?>>
                        <li><a href="other_mst_persons.php">Add Other MST Persons</a></li>
                         <li><a href="school_visits.php">Add School Visits</a></li>
                          <li><a href="special_days.php">Add Special Days</a></li>
                   </ul>
					</li>
                    
                   
                    
                    <li><a href="logout.php" style="border-bottom:none;"><i class="fa fa-power-off"></i>Logout</a></li>
                     
                     
                     <?php } ?>

				</ul>
			</div>
		</div>