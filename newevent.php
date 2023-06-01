
<div class="modal fade action-sheet inset" id="newevent" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title text-dark"><strong>New event</strong></h4>
                        
                    </div> 
                    <div class="modal-body">
                        <div class="action-sheet-content">
                        <form action="forms.php" method="POST" enctype="multipart/form-data">    
                            <br>
                            	<div class="form-group boxed">
                                    <div class="input-wrapper">
                                        <label class="label text-blue" for="">Name</label>
                                        <input class="form-control" placeholder="Name"  style="color: black !important;" name="eventname">
                                    </div>
                                </div>
                                
                                <div class="form-group boxed">
                                    <div class="input-wrapper">
                                        <label class="label text-blue" for="">Category</label>
                                        <select class="form-control custom-select text-dark" name="category" id="select">
                                            <option value="Aerobics">Aerobics</option>
                                            <option value="Biking">Biking</option>
                                            <option value="Run">Endurance walk</option>
                                            <option value="Hike">Hike</option>
                                            <option value="Run">Run</option>
                                            <option value="Swimming">Swimming</option>
                                            <option value="Yoga">Yoga</option>
                                        </select>
                                    </div>
                                </div>
                                
                             <div class="form-group boxed">
                                    <div class="input-wrapper">
                                        <label class="label text-blue" for="text11d">Details</label>
                                        <textarea rows="5" cols="50" maxlength="10000" type="text" name="details" class="form-control form-control-lg" value=""> </textarea>  
                                        <i class="clear-input">
                                            <ion-icon name="close-circle"></ion-icon>
                                        </i>
                                    </div>
                                </div>    
                                
                                <div class="form-group boxed">
                                    <div class="input-wrapper">
                                        <label class="label text-blue" for="">Date</label>
                                        <input type="date" class="form-control"  style="color: black !important;" name="eventdate">
                                    </div>
                                </div>
                                
                                <div class="form-group boxed">
                                    <div class="input-wrapper">
                                        <label class="label text-blue" for="">Time</label>
                                        <input type="time" class="form-control"  style="color: black !important;" name="eventtime">
                                    </div>
                                </div>
                                
                                <div class="form-group boxed">
                                    <div class="input-wrapper">
                                        <label class="label text-blue" for="">Location</label>
                                        <input class="form-control"  style="color: black !important;" name="location">
                                    </div>
                                    <div class="input-info">*Location will not be included in the event preview for hiking events</div>
                                </div>
                            	
                            	<div class="form-group boxed">
                                    <div class="input-wrapper">
                                        <label class="label text-blue" for="">Rallypoint</label>
                                        <input class="form-control"  style="color: black !important;" name="rallypoint">
                                    </div>
                                </div>
                                
                                <div class="form-group boxed">
                                    <div class="input-wrapper mb-2">
                                        <label class="label text-blue">Cost (₦)</label>
                                        <input type="text" class="form-control" placeholder="Enter an amount (₦)" value="0.00" name="cost">
                                    </div>
                                </div>
                                
                                
                                
                                <div class="form-group boxed">
                                    <div class="input-wrapper">
                                        <label class="label text-blue" for="">State</label>
                                        <select class="form-control custom-select text-dark" name="state" id="select">
                                                <option value="ABUJA FCT">ABUJA FCT</option>
                                                <option value="ABIA">ABIA</option>
                                                <option value="ADAMAWA">ADAMAWA</option>
                                                <option value="AKWA IBOM">AKWA IBOM</option>
                                                <option value="ANAMBRA">ANAMBRA</option>
                                                <option value="BAUCHI">BAUCHI</option>
                                                <option value="BAYELSA">BAYELSA</option>
                                                <option value="BENUE">BENUE</option>
                                                <option value="BORNO">BORNO</option>
                                                <option value="CROSS RIVER">CROSS RIVER</option>
                                                <option value="DELTA">DELTA</option>
                                                <option value="EBONYI">EBONYI</option>
                                                <option value="EDO">EDO</option>
                                                <option value="EKITI">EKITI</option>
                                                <option value="ENUGU">ENUGU</option>
                                                <option value="GOMBE">GOMBE</option>
                                                <option value="IMO">IMO</option>
                                                <option value="JIGAWA">JIGAWA</option>
                                                <option value="KADUNA">KADUNA</option>
                                                <option value="KANO">KANO</option>
                                                <option value="KATSINA">KATSINA</option>
                                                <option value="KEBBI">KEBBI</option>
                                                <option value="KOGI">KOGI</option>
                                                <option value="KWARA">KWARA</option>
                                                <option value="LAGOS">LAGOS</option>
                                                <option value="NASARAWA">NASSARAWA</option>
                                                <option value="NIGER">NIGER</option>
                                                <option value="OGUN">OGUN</option>
                                                <option value="ONDO">ONDO</option>
                                                <option value="OSUN">OSUN</option>
                                                <option value="OYO">OYO</option>
                                                <option value="PLATEAU">PLATEAU</option>
                                                <option value="RIVERS">RIVERS</option>
                                                <option value="SOKOTO">SOKOTO</option>
                                                <option value="TARABA">TARABA</option>
                                                <option value="YOBE">YOBE</option>
                                                <option value="ZAMFARA">ZAMFARA</option>
                                            </select>
                                    </div>
                                </div>
                               
                                <div class="form-group basic">
                                    <div class="input-wrapper">
                                        <input type="hidden" class="form-control" id="" value="<? echo $userid; ?> " name="createdby">
                                    </div>
                                    <div class="input-wrapper">
                                        <input type="hidden" class="form-control" id="" value="<? echo $userid; ?> " name="admin">
                                    </div>
                                </div>
                                
                                <div class="form-group basic">
                                     <input type="submit"  class="btn bg-red rounded shadowed text-light btn-lg btn-block  mr-1"
                                     value="Done" name="createevent">
                                     <i class="input-icon">
                                        <i class="material-icons text-light">chevron_right</i>
                                    </i>
                                </div>
                                <br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>