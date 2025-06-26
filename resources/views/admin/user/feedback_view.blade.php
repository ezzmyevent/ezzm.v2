<div class="modal-content">

    <!-- Modal Header -->
    <div class="modal-header">
        <h1 class="modal-title">View Feedback</h1>
    </div>

    <!-- Modal body -->
    <div class="modal-body">

        <div class="row">
            <div class="col-md-12">
                <label class="blue">1.How satisfied were you with the overall event?</label>
                <div class="check-list">
                   <span><b>{{ $feedback->satisfied_event  }}</b></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="blue">2.Did you like the facilities?</label>
                <div class="check-list">
                    <span><b>{{ $feedback->facilities  }}</b></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="blue">3.Was the overall content relevant?</label>
                <div class="check-list">
                    <span><b>{{ $feedback->content_relevant  }}</b></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="blue">4.Would you recommend the conference to colleagues?</label>
                <div class="check-list">
                    <span><b>{{ $feedback->conference_colleagues  }}</b></span>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="blue">5.How satisfied were you with the keynote presentation? </label>
                <p class="sub-feedback">Computational Integration of Product Development (Dr. Venugopal Rao)</p>
                <div class="check-list">
                    <span><b>{{ $feedback->computational_integration  }}</b></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <p class="sub-feedback">Role of Simulation in Development on Antennas & Radomes (Dr. D. R. JAHAGIRDAR)</p>
                <div class="check-list">
                    <span><b>{{ $feedback->antennas_radomes  }}</b></span>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="blue">6. Please rate the following presentations: </label>
                <p class="sub-feedback">Simulating the Future of Aerospace & Defense: Trends & updates (Geetha AVULA) </p>
                <div class="check-list">
                    <span><b>{{ $feedback->simulating_future  }}</b></span>
                </div>
                <p class="sub-feedback">Structure Design & Validation (Ranjit GOPI) </p>
                <div class="check-list">
                    <span><b>{{ $feedback->structure_design  }}</b></span>
                </div>

                <p class="sub-feedback">Aerodynamic and Aeroacoustics Performance of Aerial Vehicle (Amit JADHAV) </p>
                <div class="check-list">
                    <span><b>{{ $feedback->aerodynamic  }}</b></span>
                </div>

                <p class="sub-feedback">Vibro-acoustic Modeling for Defense Application (Karthik BALACHANDRAN) </p>
                <div class="check-list">
                    <span><b>{{ $feedback->vibro_acoustic  }}</b></span>
                </div>

                <p class="sub-feedback">Aircraft Communication & Detection System Performance (Rijin SASEENDRAN)</p>
                <div class="check-list">
                <span><b>{{ $feedback->aircraft_communication  }}</b></span>
                </div>

                <p class="sub-feedback">Multiphysics Based Design of Airborne Radomes (Siva Sai Krishna PURANAM)</p>
                <div class="check-list">
                    <span><b>{{ $feedback->multiphysics  }}</b></span>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="blue">7. What presentations were most beneficial to you?</label>
                <span><b>{{ $feedback->presentations  }}</b></span>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="blue">8.How did you hear about this event?</label>
                <span><b>{{ $feedback->hear_about_event  }}</b></span>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="blue">9.Do you have any comments/suggestions about the event, presentations, or topics? How can we improve the event?</label>
                <span><b>{{ $feedback->comments_suggestions  }}</b></span>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="blue">10. What SIMULIA solutions do you or your company currently use or plan to add?  </label>
                <p class="sub-feedback">3DEXPERIENCE platform</p>
                <div class="check-list">
                    <span><b>{{ $feedback->exp_platform  }}</b></span>
                </div>

                <p class="sub-feedback">CST Studio Suite</p>
                <div class="check-list">
                    <span><b>{{ $feedback->cst_studio  }}</b></span>
                </div>
                <p class="sub-feedback">Abaqus</p>
                <div class="check-list">
                    <span><b>{{ $feedback->abaqus  }}</b></span>
                </div>
                <p class="sub-feedback">fe-safe</p>
                <div class="check-list">
                    <span><b>{{ $feedback->fe_safe  }}</b></span>
                </div>
                <p class="sub-feedback">Isight</p>
                <div class="check-list">
                    <span><b>{{ $feedback->isight  }}</b></span>
                </div>

                <p class="sub-feedback">3DEXPERIENCE platform</p>
                <div class="check-list">
                    <span><b></b></span>
                </div>

                <p class="sub-feedback">Simpack</p>
                <div class="check-list">
                    <span><b>{{ $feedback->simpack  }}</b></span>
                </div>

                <p class="sub-feedback">Tosca</p>
                <div class="check-list">
                    <span><b>{{ $feedback->tosca  }}</b></span>
                </div>

                <p class="sub-feedback">Wave6</p>
                <div class="check-list">
                    <span><b>{{ $feedback->wave6  }}</b></span>
                </div>

                <p class="sub-feedback">PowerFLOW</p>
                <div class="check-list">
                    <span><b>{{ $feedback->power_flow  }}</b></span>
                </div>

            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label class="blue">11. Would you like a Dassault Systèmes representative to contact you regarding any of the topics listed below?</label>
                <div class="check-list">
                    <span><b>{{ $feedback->dassault_system  }}</b></span>
                </div>

            </div>
        </div>

    </div>


</div>

