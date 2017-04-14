                    <div id="date">
                        <div id="date_1">
                            <p id="date_2">Date: </p>
                        </div>
                        <div id="date_3">
                            <div id="month_1">
                                <select name="month" id="month">
                                    
                                <?php include("month_array.php"); ?>
                                    
                                </select>
                            </div>
                            <div id="day_1">
                                <select name="day" id="day">
                                    
                                    <?php include("day_array.php"); ?>
                                    
                                  </select>
                            </div>
                            <div id="year_1">
                                <select name="year" id="year">
                                    
                                    <?php include("year_array.php"); ?>
                                    
                                 </select>
                            </div>
                        </div>
                    </div>
                    <div id="job">
                        <p id="job_1">Job Name:</p>
                        
                            <?php include ('job.php'); ?>
                        
                    </div>
                    <div id="description">
                        <div id="description_1">
                            <p id="description_2">Job Description:</p>
                        </div>
                        <div id="description_text">
                            
                            <?php include ('description.php'); ?>
                            
                        </div>
                    </div>
                    <div id="time_in">
                        <div id="time_in_1">
                            <p id="time_in_2">Time-In:</p>
                        </div>
                        <div class="time_3">
                            <div class="hour">
                                <p class="hour_1">Hour:</p>
                                                                    
                                <?php include ('hour_in_array.php'); ?>
                                    
                            </div>
                            <div class="minute">
                            <p class="minute_1">Minute:</p>
                                
                                <?php include ('minute_in_array.php')?>
                                    
                            </div>
                            <div class="am_pm">
                            <p class="am_pm_1">AM/PM</p>
                                
                                <?php include ('am_pm_in_array.php'); ?>
                                
                            </div>
                        </div>
                    </div>
                    <div id="time_out">
                        <div id="time_out_1">
                            <p id="time_out_2">Time-Out:</p>
                        </div>
                        <div class="time_3">
                            <div class="hour">
                                <p class="hour_1">Hour:</p>
                                
                                <?php include ('hour_out_array.php'); ?>
                                
                            </div>
                            <div class="minute">
                            <p class="minute_1">Minute:</p>
                                
                                <?php include ('minute_out_array.php'); ?>
                                
                            </div>
                            <div class="am_pm">
                            <p class="am_pm_1">AM/PM</p>
                                
                                <?php include ('am_pm_out_array.php'); ?>
                                
                            </div>
                        </div>
                    </div>
                    <div id="lunch">
                        <div id="lunch_1">
                            <p id="lunch_2">Lunch:</p>
                        </div>
                        <div id="lunch_time_1">
                            
                            <?php include ('lunch_array.php'); ?>
                            
                        </div>