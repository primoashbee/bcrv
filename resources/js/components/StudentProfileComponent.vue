<template>
    <div class="" v-if="loaded">
        <div class="card">
            <div class="card-header">
                <h3> Setup your profile 

                </h3>


            </div>
            <div class="card-body">
                <transition name="slide-fade">

                    <div id="profile" v-if="step==1">
                        <h3> Basic Profile
                            <a href="#" class="badge badge-success" v-if="profile.finished">Finished</a>
                            <a href="#" class="badge badge-danger" v-else>On-going</a>
                        </h3>
                        
                        <div class="row">
                            <div class="col-md-4 col-xs-12 ">
                                <div class="form-group">
                                    <label for="firstname">First Name <span style="color:red"> * </span></label>
                                    <input type="text" class="form-control" v-model="profile.firstname">
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label for="lastname">Last Name <span style="color:red"> * </span></label>
                                    <input type="text" class="form-control" v-model="profile.lastname">
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-12">
                                <div class="form-group">
                                    <label for="middlename">Middle Name</label>
                                    <input type="text" class="form-control" v-model="profile.middlename">
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-12">
                                <div class="form-group">
                                    <label for="ext_name">Extension Name</label>
                                    <input type="text" class="form-control" v-model="profile.ext_name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 col-xs-12">
                                <div class="form-group">
                                    <label for="ext_name">Course <span style="color:red"> * </span></label>
                                    <select v-model="profile.courses" multiple="true" class="form-control">
                                        <option v-for="(item, key) in setup.courses" :value="item.id">{{item.course_name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label for="ext_name">Address <span style="color:red"> * </span></label>
                                    <input type="text" class="form-control" v-model="profile.address">
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-12">
                                <div class="form-group">
                                    <label for="phone">Phone <span style="color:red"> * </span></label>
                                    <input type="text" class="form-control" v-model="profile.contact_number"/>
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-12">
                                <div class="form-group">
                                    <label for="ext_name">Year <span style="color:red"> * </span> </label>
                                    <select v-model="profile.school_year"  class="form-control">
                                        <option v-for="(item, key) in setup.years" :value="item">{{item}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-12">
                                <div class="form-group">
                                    <label for="ext_name">Batch <span style="color:red"> * </span></label>
                                    <select v-model="profile.batch"  class="form-control">
                                        <option v-for="(item, key) in setup.batches" :value="item">{{item}}</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <button class="btn btn-success float-right" @click="submit(step)" > Save </button>

                    </div>
                </transition>
                <transition name="slide-fade">

                    <div id="requirements" v-if="step==2">
                        <h3> Requirements
                            <a :href="false" class="badge badge-success" v-if="requirements.finished">Finished</a>
                            <a :href="false" class="badge badge-danger" v-else>On-going</a>
                        </h3>
                        <div class="form-group" v-for="(item,key) in requirements.list">
                            <label> {{item.requirement.name }}
                                
                            </label>
                            <div v-if="item.status ==1 || item.status==2">
                                <a :href="`/requirements/view/${item.id}`" target="_blank" class="badge badge-success"><i class="fa fa-eye"></i></a>
                                <a :href="`/requirements/download/${item.id}`"  class="badge badge-success"><i class="fa fa-download"></i></a>
                                <span > Submitted on: {{item.updated_at}}</span>                    
                            </div>

                            <div class="custom-file">

                                <input type="file" :class="fileClass(item)"  :name="fileHTMLId(item)" :id="fileHTMLId(item)" :readonly="fileReadOnly(item)" @change="fileChanged($event, item)">
                    
                            
                                <label class="custom-file-label" :for="fileHTMLId(item)" v-bind:id="`file-upload-label-${item.id}`" required> Choose File</label>
                                <div :class="fileDivClass(item)">
                                {{item.html['message']}}
                                </div>

                            </div>
                        </div>
                        <button class="btn btn-success float-right" @click="submit(step)" > Save </button>


                    </div>
                </transition>
                <transition name="slide-fade"  v-if="step==3">

                    <div id="requirements">
                        <h3> Learner's Profile
                            <a :href="false" class="badge badge-success" v-if="learners.finished">Finished</a>
                            <a :href="false" class="badge badge-danger" v-else>On-going</a>
                        </h3>
                        <a href="/learner/profile" class="btn btn-success float-right"> Setup Learner's Profile </a>
                    </div>
                </transition>

            </div>
            <div class="card-footer">
                <button class="btn btn-success float-left" @click="back" v-if="step > 1"> Back </button>
                <button class="btn btn-success float-right" @click="next" v-if="step < 3" :disabled="disabled"> Next </button>
                <button class="btn btn-success float-right" @click="next" v-if="step == 3"> Submit </button>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    props : ['courses'],
    async created(){
        await this.init()
    },
    data(){
        return {
            step: 1,
            loaded: false,
            profile : {
                firstname: "",
                lastname : "",
                middlename: "",
                ext_name: "",
                courses: [],
                contact_number: "09685794313",
                school_year: "2022",
                batch: "1",
                address: "",
                finished: false,


            },
            requirements: {
                list : [],
                submit:[],
                finished: false
            },
            learners : {
                // learner_id: "",
                // entry_date: "",
                // lastname: "",
                // firstname: "",
                // middlename: "",
                // ext_name: "",
                // street: "",
                // barangay:"",
                // district:"",
                // city:"",
                // province:"",
                // region:"",
                // email:"",
                // contact_number:"",
                // nationality:"",
                // gender:"",
                // civil_status:"",
                // employement_status:"",
                // birthday:"",
                // birth_city:"",
                // birth_province:"",
                // education_attainment:"",
                // parent_name:"",
                // parent_mailing_address:"",
                // classification: {},
                // disability: {},
                // course_qualification:"",
                // scholarship_package:"",
                // date_received:"",
                
                finished: false
            },

            setup : {
                courses: [],
                batches: [],
                years  : []
            },
            errors : []
        }
    },
    methods : {
        async init(){
            const alert = Swal.fire({
                title: 'Loading',
                timerProgressBar: true,
                didOpen: () => {
                    Swal.showLoading()
                  
                }
                
            })
            const { data } = await axios.get('/setup')
            this.setup.courses = data.courses;
            this.setup.batches = data.batches;
            this.setup.years = data.years;
            
            this.requirements.list = data.list
            this.requirements.finished = data.steps.find(x=>x.step == 2).finished
            this.setProfile(data.profile, data.profile.courses)
            this.learners.finished = data.steps.find(x=>x.step==3)?.finished
            this.loaded = true
            alert.close()

        },
        setProfile(data, courses){
            this.profile.firstname = data.firstname;
            this.profile.lastname = data.lastname;
            this.profile.middlename = data.middlename;
            this.profile.ext_name = data.ext_name;
            this.profile.courses = courses.map(x=> {return x.id} )
            this.profile.contact_number = data.contact_number;
            this.profile.school_year    = data.school_year;
            this.profile.batch = data.batch;
            this.profile.address = data.address;
            this.profile.finished = data.is_finished;
        },  
        fileReadOnly(file){
            return file.status == 2
        },
        fileClass(file){
            return `custom-file-input ${file.html['class']}`;
        },
        fileHTMLId(file){
            return `requirement[${file.requirement_id}]`
        },
        fileDivClass(file)
        {
            return file.html['feedback_class']
        },
        fileChanged(event, file){
            const filename = event.target.value;
            const file_upload     = event.target.files[0];
            const data = {
                requirement_id: file.id,
                file: file_upload
            }
            const el = document.getElementById(`file-upload-label-${file.id}`);
            el.innerHTML = file_upload.name

            this.requirements.list.find(x=>x.id == file.id).html.class = ""
            const requirements = this.requirements.submit.filter(x=> x.requirement != file.id);
            requirements.push(data)
            this.requirements.submit = requirements
            
        },
        fileUploadID(item){
            return `file-upload-label-${item.id}`
        },
        async submit(step){
            if(step==1){
                try{
                    const { data }  = await axios.post('/setup/profile', this.profile)
                    this.errors = []
                    this.profile.finished = true
                    Swal.fire(data.message, 'Please proceed to the next step', 'success');

                }catch(e){
                    if(e.response.status == 422)
                    {
                        this.errors = e.response.data.errors
                        Swal.fire('Please fill required fields', '', 'info');


                    }
                }
                return;
            }
            if(step==2){
                try{
                    const formData = new FormData();
                    const list = [];
                    this.requirements.submit.map(x=>{
                        formData.append('requirement_id[]', x.requirement_id)
                        formData.append('file[]', x.file)
                    })
                    // formData.append("files", this.requirements.)
                    const { data }  = await axios.post('/setup/requirements', formData)
                    this.errors = []
                    this.requirements.finished = data.finished
                    if(data.finished == 1){
                        Swal.fire(data.message, 'Please proceed to the next step', 'success');
                        this.step++;
                    }else{
                        Swal.fire(data.message, 'Please complete all the requirements', 'success');

                    }

                }catch(e){
                    console.log(e)
                    if(e.response.status == 422)
                    {
                        this.errors = e.response.data.errors
                        Swal.fire('Please fill required fields', '', 'info');

                    }
                }
                this.requirements.finished = true
                return;
            }
            if(step==3){
                alert('submitting learners profile')
                this.learners.finished = true
                return;
            }
        },
        next(){
            if(this.step ==3){
                return;
            }
            this.step++
            return;
        },
        back(){
            if(this.step ==1){
                return;
            }
            this.step--;
            return;
        },
    },
    computed : {
        disabled()
        {
            if(this.step == 1){
                return !this.profile.finished;
            }
            if(this.step == 2){
                return !this.requirements.finished 
            }
            if(this.step == 3){
                return !this.learners.finished    
            }
        }
    }
}

</script>

<style scoped>
.fade-enter-active, .fade-leave-active {
  transition: opacity .5s;
}
.fade-enter, .fade-leave-to /* .fade-leave-active below version 2.1.8 */ {
  opacity: 0;
}

.slide-fade-enter-active {
  transition: all .3s ease;
}
.slide-fade-leave-active {
  transition: all 1s cubic-bezier(1.0, 0.5, 0.8, 1.0);
}
.slide-fade-enter, .slide-fade-leave-to
/* .slide-fade-leave-active below version 2.1.8 */ {
  transform: translateX(10px);
  opacity: 0;
}
</style>