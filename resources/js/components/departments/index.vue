<template>
    <div class="container">
         <div class="invoices">
        
        <div class="card__header">
            
            <div>
                
                <router-link class="btn btn-secondary" to="/">User</router-link>
                
                <router-link class="btn btn-primary" to="/department">Department</router-link>
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
                                Department List
                            </p>
                            </li>
                            <li>
                            <p class="table--filter--link ">
                                <a class="btn btn-secondary" @click="onCreate">
                                    New Department
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
                    <input class="table--search--input" type="text" placeholder="Search invoice" >
                </div>
            </div>

            <div class="table--heading">
                <p>ID</p>
                <p>Department Name</p>
                <p></p>
                <p></p>
            </div>

            <!-- item 1 -->
            <div v-if="departments.length > 0">

                <div class="table--items" v-for="department in departments" :key="department" >
                    <a href="#" class="table--items--transactionId">#{{department.id}}</a>
                    <p>{{department.name}}</p>
                    <button @click="onEdit(department.id)">edit</button>
                    <button @click="onDelete(department.id)">delete</button>
                </div>
            </div>
            <div v-else>
                <p>Department not found</p>

            </div>
            </div>
            
        </div>
        
    </div>

</template>
<script setup>

import { onMounted, ref } from "vue"
import { useRouter } from "vue-router"

const router = useRouter()

let departments = ref([])
let searchUser = ref([])

 onMounted( async () => {
    getdepartments() 
 })  //get user method is called every time the page 


 const getdepartments = async () => {
     let response = await axios.get("/api/department_index")
     
     departments.value = response.data.departments
     console.log(departments)
 }

  const onCreate = async () => {
    
     router.push('/department/create')
 }

const onEdit = (id) =>{

     router.push('/department/edit/'+id)

 }

const onDelete = (id) =>{

    Swal.fire({
         title:'Are you sure?',
         text:"to delete Department",
         icon:"warning",
         showCancelButton:true,
         confirmButtonColor:'#3085d6',
         cancelButtonText:'No',
         confirmButtonText:'Yes'
     })
    .then((result) => {
         console.log(id);
         if(result.value){

             axios.post('/api/department_delete/'+id)
                .then(()=>{
                    
                    toast.fire({
                        icon:"success",
                        title:"Department deleted successfully"
                    })

                    getdepartments()
                })
                .catch(()=>{
                   Swal.fire("Failed!","There was something wrong.", "Warning")
                }) 
            }
        })

 }

 </script>
