<script setup>
import { onMounted, ref } from 'vue'
import { useRouter} from 'vue-router'

const router = useRouter()

let form = ref({
    id:'',
    fullname: '',
    email: '',
    password: '',
    departments: ''
})
 const selected = ref('')

 let departments = ref({
     id:'',
     name:''
 })

onMounted(async () => {
    
    getEditUser()
})

const props = defineProps({
    id:{
        type:String,
        default:''
    }
})
const getEditUser = async () => {
    let response = await axios.get(`/api/user_edit/${props.id}`)
    
    form.value = response.data.user

    selected.value = response.data.department
    

    departments.value = response.data.departments

    console.log(response.data.department)

}

const  updateUser = () =>{

    const formData = new FormData()

    formData.append('fullname',form.value.fullname)
    formData.append('email',form.value.email)
    formData.append('password',form.value.password)
    formData.append('department_id',selected.value)
console.log(formData)
    axios.post(`/api/user_update/${form.value.id}`, formData)
    .then((response)=>{

        form.value.fullname = '',
        form.value.email = '',
        form.value.password = '',
        selected.value = ''

        router.push('/')

        toast.fire({
            icon:"success",
            title:"User update successfully"
        })
    })
    .catch(error => {
            let errors = error.response.data.errors; // this should be errors.
             console.log(errors);

        Swal.fire({
         title:'',
         text:errors,
         icon:"error"
     })
        })

    //console.log(formData)
}
</script>
<template>
    <div class="container">
        
        <div class="card__header">
            <div>
                <h2 class="user_title">Edit User</h2>
            </div>
            <div>
                <router-link to="/"> Back</router-link>
            </div>
        </div>

        <div class="card__content">
            <div class="card__content--header">
                <div>
                    <p class="my-1">Department </p>

                    <select  class="input" v-model="selected">
                        <option v-for="department in departments" :key="department" :value="department.id">{{ department.name }}</option>
                    </select>

                    <p class="my-1">Full Name</p> 
                    <input type="text" class="input" v-model="form.fullname"> 
                </div>
                <div>
                    <p class="my-1">Email</p> 
                    <input type="email" class="input" v-model="form.email"> 

                    <p class="my-1">Password</p> 
                    <input type="password" class="input" v-model="form.password">
                </div>
            </div>    
        </div>
        <div class="card__header" style="margin-top: 40px;">
            
            <div>
                <a class="btn btn-secondary" @click="updateUser">
                    Update
                </a>
            </div>
        </div>

    </div>
</template>

