<template>
    <div class="container">
         
        
        <div class="card__header">
            
            <div>
                
                <router-link class="btn btn-primary" to="/">User</router-link>
                
                <router-link class="btn btn-secondary" to="/department">Department</router-link>
            </div>
        </div>

        <div class="table card__content">
            <div class="table--filter">
                <span class="table--filter--collapseBtn ">
                    <i class="fas fa-ellipsis-h"></i>
                </span>
                <div class="table--filter--listWrapper">
                    <ul class="table--filter--list">
                        <li>
                            <p class="table--filter--link ">
                                User List
                            </p>
                            </li>
                            <li>
                            <p class="table--filter--link ">
                                <a class="btn btn-secondary" @click="onCreate">
                                    New User
                                </a>
                            </p>
                        </li>
                        
                    </ul>
                </div>
            </div>

            <div class="table--search">
                <div class="table--search--wrapper">
                    <select class="table--search--select" name="" id="">
                        <option value="">Search by full name</option>
                    </select>
                </div>
                <div class="relative">
                    <i class="table--search--input--icon fas fa-search "></i>
                    <input class="table--search--input" type="text" placeholder="Search user" v-model="searchUser" @keyup="search()">
                </div>
            </div>

            <div class="table--heading">
                <p>ID</p>
                <p>Full Name</p>
                <p>Email</p>
                <p>Department</p>
                <p></p>
                <p></p>
            </div>

            <!-- item 1 -->
            <div v-if="users.length > 0">

                <div class="table--items" v-for="user in users" :key="user" >
                    <a href="#" class="table--items--transactionId">#{{user.id}}</a>
                    <p>{{user.fullname}}</p>
                    <p>{{user.email}}</p>
                    
                    <p v-for="department in user.departments" :key="department"> {{department.name}}</p>
                    <button @click="onEdit(user.id)">edit</button>
                    <button @click="onDelete(user.id)">delete</button>
                </div>
            </div>
            <div v-else>
                <p>User not found</p>

            </div>
        </div>
            
        
        
    </div>

</template>

<script setup>

import { onMounted, ref } from "vue"
import { useRouter } from "vue-router"

const router = useRouter()

let users = ref([])
let searchUser = ref([])

 onMounted( async () => {
    getUsers() 
 })  //get user method is called every time the page 

 const search = async () => {
     let response = await axios.get('/api/user_search?s='+searchUser.value)
    console.log('response', response.data.users)
    users.value = response.data.users
 }

 const getUsers = async () => {
     let response = await axios.get("/api/user_index")
     
     users.value = response.data.users
     console.log(users)
 }

 const onCreate = async () => {
    
     router.push('/user/create')
 }

  const onEdit = (id) =>{

     router.push('/user/edit/'+id)

 }

  const onDelete = (id) =>{

    Swal.fire({
         title:'Are you sure?',
         text:"to delete user",
         icon:"warning",
         showCancelButton:true,
         confirmButtonColor:'#3085d6',
         cancelButtonText:'No',
         confirmButtonText:'Yes'
     })
    .then((result) => {
         console.log(id);
         if(result.value){

             axios.post('/api/uesr_delete/'+id)
                .then(()=>{
                    
                    toast.fire({
                        icon:"success",
                        title:"user deleted successfully"
                    })

                    getUsers()
                })
                .catch(()=>{
                   Swal.fire("Failed!","There was something wrong.", "Warning")
                }) 
            }
        })

 }
</script>
