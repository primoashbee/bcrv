<template>
    <div class="">
        <div class="card">
            <div class="card-header">
                <h3> Setup your profile</h3>

            </div>
            <div class="card-body">
                <transition name="slide-fade">

                    <div id="profile" v-if="step==1">
                        <h3> Basic Profile</h3>
                        <div class="row">
                            <div class="col-md-4 col-xs-12 ">
                                <div class="form-group">
                                    <label for="firstname">First Name</label>
                                    <input type="text" class="form-control" v-model="profile.firstname">
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label for="lastname">Last Name</label>
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
                                    <label for="ext_name">Course </label>
                                    <select v-model="profile.courses" multiple="true" class="form-control">
                                        <option v-for="(item, key) in setup.courses" :value="item.id">{{item.course_name}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-xs-12">
                                <div class="form-group">
                                    <label for="ext_name">Address </label>
                                    <input type="text" class="form-control" v-model="profile.address">
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-12">
                                <div class="form-group">
                                    <label for="phone">Phone </label>
                                    <input type="text" class="form-control" v-model="profile.contact_number"/>
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-12">
                                <div class="form-group">
                                    <label for="ext_name">Year </label>
                                    <select v-model="profile.school_year"  class="form-control">
                                        <option v-for="(item, key) in setup.years" :value="item">{{item}}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-12">
                                <div class="form-group">
                                    <label for="ext_name">Batch </label>
                                    <select v-model="profile.batch"  class="form-control">
                                        <option v-for="(item, key) in setup.batches" :value="item">{{item}}</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                    </div>
                </transition>
                <transition name="slide-fade">

                    <div id="requirements" v-if="step==2">
                        <h3> Requirements</h3>

                    </div>
                </transition>
                <transition name="slide-fade"  v-if="step==3">

                    <div id="requirements">
                        <h3> Learner's Profile</h3>

                    </div>
                </transition>

            </div>
            <div class="card-footer">
                <button class="btn btn-success float-left" @click="back" v-if="step>1"> Back </button>
                <button class="btn btn-success float-right" @click="next" v-if="step<3"> Next </button>
                <button class="btn btn-success float-right" @click="next" v-if="step==3"> Submit </button>
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
            profile : {
                firstname: "",
                lastname : "",
                middlename: "",
                ext_name: "",
                courses: [],
                contact_number: "09685794313",
                school_year: "2022",
                batch: "1",
                address: ""


            },
            setup : {
                courses: [],
                batches: [],
                years  : []
            }
        }
    },
    methods : {
        async init(){
            const { data } = await axios.get('/setup')
            this.setup.courses = data.courses;
            this.setup.batches = data.batches;
            this.setup.years = data.years;
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