<template>
    <div class="card">
        <div class="card-header">
            <h2 class="font-weight-blod text-center">Form Phonebook</h2>
        </div>
        <div class="card-body">

            <form action="" v-on:submit.prevent="save()">
                <div class="form-group">
                    <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <label for="firstname">Firstname:</label>
                        <input id="firstname" type="text" placeholder="Person firstname ..." 
                        v-model="model.firstname" />
                    </div>
                    <div class="col-md-6 col-sm-12">
                    <label for="lastname">Lastname:</label>
                    <input id="lastname" type="text" placeholder="Person lastname ..." 
                    v-model="model.lastname"  />
                    </div>
                    </div>
                </div>

                <div class="form-group">
                    <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <label for="age">Age:</label>
                        <input id="age" type="text" placeholder="Person age ..." 
                        v-model="model.age"  />
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <label for="sex">Sex:</label>
                        <input id="sex" type="text" placeholder="Person sex ..." 
                        v-model="model.sex"   />
                    </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="phone">Phone:</label>
                    <input id="phone" type="text" placeholder="Person phone ..." 
                    v-model="model.phone"  />
                </div>
                
                <div class="form-group">
                    <label for="address">Address:</label>
                    <input id="address" type="text" placeholder="Person address ..." 
                    v-model="model.address"  />
                </div>

                <button class="btn btn-primary" >Save </button>
            </form>

        </div>
    </div>


    
</template>

<script>
    export default {
        props: ["data"],

        data(){
            return {
                model: {
                    id:0, 
                    firstname:"",
                    lastname:"",
                    age:'',
                    sex:'',
                    address:'',
                    phone:''
                }
            }
        },
        mounted() {
            console.log('Component mounted.');
            this.fill();
        },
        methods:{
            fill(){
                if(this.data){
                    this.model = this.data;
                }else{
                    console.log("Not data loaded");
                }
            },
            save(){
                this.$emit('onSave', this.model);
                this.clear();
                console.log('--------------- Edit::save');
                console.log(this.model);

            },
            clear(){
                this.model = {
                    id:0, 
                    firstname:"",
                    lastname:"",
                    age:'',
                    sex:'',
                    address:'',
                    phone:''
                };
            }
        }
    }
</script>
