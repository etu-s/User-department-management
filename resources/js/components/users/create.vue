<template>
    <div class="container">
        
        <div class="card__header">
            <div>
                <h2 class="user_title">New User</h2>
            </div>
            <div>
                <router-link to="/"> Back</router-link>
            </div>
        </div>

        <div class="card__content">
            <div class="card__content--header">
                <div>
                    <p class="my-1">Select department</p>
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
                <a class="btn btn-secondary" @click="saveUser">
                    Save
                </a>
            </div>
        </div>

    </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import { useRouter} from 'vue-router'

const router = useRouter()

let form = ref({
    fullname: '',
    email: '',
    password: ''
})

 const selected = ref('1')

 let departments = ref({
     id:'',
     name:''
 })

 onMounted(async () => {
    
    getCreateUser()
})

const getCreateUser = async () => {
    let response = await axios.get('/api/user_create')

    departments.value = response.data.departments

    console.log(response.data.departments)

}

const  saveUser = () =>{

    const formData = new FormData()

    formData.append('fullname',form.value.fullname)
    formData.append('email',form.value.email)
    formData.append('password',form.value.password)
    formData.append('department_id',selected.value)

    axios.post("/api/user_add/", formData)
    .then((response)=>{

        form.value.fullname = '',
        form.value.email = '',
        form.value.password = '',
        selected.value = ''

        router.push('/')

        toast.fire({
            icon:"success",
            title:"user add successfully"
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