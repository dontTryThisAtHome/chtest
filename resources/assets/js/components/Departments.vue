<template>
    <div id='departments' class='widget table-responsive'>
        <h2 class="widget-header">#Отделы</h2>
        <table class='table'>
            <thead>
                <th>Название</th>
                <th>Количество сотрудников</th>
                <th>Максимальная зарплата</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                <tr v-for="department in departments">
                    <td>{{department.name}}</td>
                    <td>{{department.peopleCount}}</td>
                    <td>{{department.maxWage}}</td>
                    <td><button type="button" class="btn btn-link" @click='editDepartment(department.id)'>Редактировать</button></td>
                    <td><button class="btn btn-link" @click='deleteDepartment(department.id)'>Удалить</button></td>
                </tr>
                <tr>
                    <td colspan="7">
                        <button class="btn btn-default" href="#" @click="addDepartment()" >добавить</button>
                        
                    </td>
                </tr>
                
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    data: function () {
            return {
                message: '',
            }
        },
    props:['departments','people','showadd','showedit','error'],
    mounted() {
        console.log('Departments mounted.')
    },
    methods:{
        addDepartment: function(){
            this.$emit('update:showadd', true);
        },
        editDepartment: function(id){
            this.$root.$emit('editDepartment', id);             
            this.$emit('update:showedit', true);
        },
        deleteDepartment: function(id){
            axios.delete('api/departments/'+id)
            .then((response)=> {
                this.update();
                this.message = '';
            })
            .catch((error) => {
                this.$root.$emit('error',error.response.data);
                this.$emit('update:error', true);
            });
        },
        update: function(){
            this.$root.$emit('update');
        }
    }
}
</script>
