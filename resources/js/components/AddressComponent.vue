<template>
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div v-for="address in addresses" v-bind:key="address.id" class="card card-default mb-2 mr-2 list-item">
                    <div class="card-header">Status:: {{ address.status }}       </div>

                    <div class="card-body">
                       {{ address.address }},{{ address.city }},{{ address.state }} ,{{ address.country }}
                      
                        <p class="text-right mt-2">
                            <button @click="editAddress(address)" class="btn btn-info">Edit</button>
                            <button @click="delAddress(address.id)" class="btn btn-danger">Delete</button>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <form>
                    

                    <div class="form-group">
                        <label for="country">Country</label>
                            <select name="country" id="country" v-model='country' @change='getCountryStates($event)' class="custom-select form-control">
                            <option value='0' >Select Country</option>
                            <option v-for='data in countries' :value='data.id'>{{ data.name }}</option>
                            </select>                        
                    </div>


                    <div class="form-group">
                        <label for="state">State</label>
                        <select name="state" id="state" v-model='state' @change='getStateCities($event)' class="custom-select form-control">
                            <option value='0' >Select State</option>
                            <option v-for='data in states' :value='data.id'>{{ data.name }}</option>
                            </select>                     
                    </div>
                    
                    <div class="form-group">
                        <label for="city">City</label>
                        <select @change='getCities()' name="city" id="city" v-model='city' class="custom-select form-control">
                        <option value='0' >Select City</option>
                        <option v-for='data in cities' :value='data.id'>{{ data.name }}</option>
                        </select>                        
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" v-model="address.address">                        
                    </div>

                    
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select id="status" name="status" class="custom-select form-control" v-model="address.status">
                           <option value="Active">Active</option>
                           <option value="Inactive">Inactive</option>
                            </select>                        
                    </div>
                    
                    <div class="form-group">
                        <button v-if="add" @click.prevent="addAddress()" class="btn btn-primary">Add Address</button>
                        <button v-if="edit" @click.prevent="updateAddress(address.id)" class="btn btn-danger">Edit Address</button>                       
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>
<style>
    .list-item{
        width: 220px;
        padding-top: 2px;
        height: 220px;
        float: left;
    }
</style>
<script>
    export default {
        data(){
            return {
                addresses:[],
                address:{
                    id:'',
                    address:'',
                    status:'',
                    country:'',
                    state:'',
                    city:'',
                    
                   
                },
                country: 0,
                countries: '',
                state: 0,
                states: '',
                city:0,
                cities: '',
                add:true,
                edit:false,
            }

        },
        created(){
                this.viewAddress();
                this.getCountry();
        },
        methods:{

           getCountry: function(){

         fetch('api/country')
                .then(res => res.json())
                .then(res =>{
                    this.countries =res.data
                         // Empty state and city
                 
                 this.states = ''
                 this.cities = ''
                 this.state = 0
                 this.city = 0
                })
                .catch(err =>console.log(err))
        

    },
    getCountryStates: function(event){

        fetch(`api/state/${this.country}`)
                .then(res => res.json())
                .then(res =>{
                    this.states =res.data
                       
                this.state = 0
                this.address.country=this.country

                // Empty city
                this.cities = ''
                this.city = 0;
                })
                .catch(err =>console.log(err))
 
    }, 

     getStateCities: function(){

        fetch(`api/city/${this.state}`)
                .then(res => res.json())
                .then(res =>{
                    this.cities =res.data
                
                this.address.state=this.state
                console.log(event.target.value) 
                this.address.city=this.$refs.city
                this.city = 0;
                })
                .catch(err =>console.log(err))

     /* axios.get('api/city', { 
        params: {
                state: this.state
        }
      }) 
      .then(function (response) {
        this.cities = response.data;
        this.city = 0;
      })*/
    },

     getCities: function(){

        fetch(`api/city/${this.city}`)
                .then(res => res.json())
                .then(res =>{
                    this.address.city=this.city
                 })
                .catch(err =>console.log(err))
    },


            viewAddress(){
                fetch('api/addresses')
                .then(res => res.json())
                .then(res =>{
                    this.addresses =res.data
                    console.log(this.addresses)
                })
                .catch(err =>console.log(err))

            },
            addAddress(){
                    fetch('api/addresses',{
                        method:'post',
                        body:JSON.stringify(this.address),
                        headers: {
                                  'content-type' : 'application/json'
                                 }
                    })
                .then(res => res.json())
                .then(data =>{
                    swal("Successfull!","Address added","success")
                    this.address.country=''
                    this.address.city=''
                    this.address.state=''
                    this.address.address=''
                    this.address.status=''
                    
                    this.viewAddress();
                })
                .catch(err =>{
                    swal("Failed!","Address fail to update","error")
                })
            },
            updateAddress(id){

                fetch(`api/addresses/${id}`,{
                    method: 'put',
                    body:JSON.stringify(this.address),
                    headers: {
                                  'conten-type' : 'application/json'
                            }
                })
                .then(res => res.json())
                .then(data =>{
                    console.log(data)
                    swal("Successfull!","Address Updated","success")
                    this.add=true
                    this.edit=false
                    this.address.country=''
                    this.address.city=''
                    this.address.state=''
                    this.address.address=''
                    this.address.status=''
                    this.viewAddress()
                })
                .catch(err =>{
                    swal("Failed!","Address fail to update","error")
                })

            },
            editAddress(pro){
                this.add=false
                this.edit=true
                this.address.id=pro.id
                this.address.country=pro.country
                this.address.city=pro.city
                this.address.state=pro.state
                this.address.address=pro.address
                this.address.status=pro.status
                

            },
            delAddress(id){
                swal({
                    title:"Are you sure!",
                    text:"Address will be delete",
                    icon:"danger",
                    button:true,
                    dangerMode:true
                }).then((willdelete)=>{
                    if(willdelete){
                        fetch(`api/addresses/${id}`,{
                    method:'delete'
                })
                .then(res => res.json())
                .then(data =>{
                   swal("Successfull!","Address deleted","success")
                   this.viewAddress();
                })
                .catch(err =>{
                    swal("Failed!","Address fail to delete","error")
                })
                    }
                 })
                
            },

        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
