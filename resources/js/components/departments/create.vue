<template>
    <div class="container">
        
        <div class="card__header">
            <div>
                <h2 class="user_title">New Department</h2>
            </div>
            <div>
                <router-link to="/department"> Back</router-link>
            </div>
        </div>

        <div class="card__content">
            <div class="card__content--header">
                <div>

                    <p class="my-1">Department Name</p> 
                    <input type="text" class="input" v-model="form.name"> 
                </div>
                
            </div>    
        </div>
        <div class="card__header" style="margin-top: 40px;">
            
            <div>
                <a class="btn btn-secondary" @click="saveDepartment">
                    Save
                </a>
            </div>
        </div>

    </div>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter} from 'vue-router'

const router = useRouter()

let form = ref({
    name: ''
})


const  saveDepartment = () =>{

    const formData = new FormData()

    formData.append('name',form.value.name)

    axios.post("/api/department_add/", formData)
    .then((response)=>{

        form.value.name = ''

        router.push('/department')

        toast.fire({
            icon:"success",
            title:"department add successfully"
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