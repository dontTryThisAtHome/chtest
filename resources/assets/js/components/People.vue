<template>
    <div id='people' class='widget table-responsive'>
        <h2 class="widget-header">#Сотрудники</h2>
        <table class='table'>
            <thead>
                <th>Имя</th>
                <th>Фамилия</th>
                <th>Пол</th>
                <th>Зарплата</th>
                <th>Отделы</th>
                <th></th>
                <th></th>
            </thead>
            <tbody>
                <tr v-for="person in people">
                    <td>{{person.name}}</td>
                    <td>{{person.surname}}</td>
                    <td>{{person.gender}}</td>
                    <td>{{person.wage}}</td>
                    <td >{{ person.departments.map(function(arr) {
                                return arr.name;
                            }).join(', ') }}
                    </td>
                    <td><button class="btn btn-link" href="#" @click = 'editPerson(person.id)'>Редактировать</button></td>
                    <td><button class="btn btn-link" href="#" @click='deletePerson(person.id)'>Удалить</button></td>
                </tr>
                <tr>
                    <td colspan="7"><button class="btn btn-default" href="#" @click = 'addPerson()'>Добавить</button></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
export default {
    data:   function () {
                return {
                    message: '',
                }
            },
    props:['departments','people','showadd','showedit'],
    mounted() {
        console.log('People mounted.')
    },
    methods:{
        addPerson: function(){
            this.$emit('update:showadd', true);
        },
        editPerson: function(id){
            this.$root.$emit('editPerson', id);
            this.$emit('update:showedit', true);
        },
        deletePerson: function(id){
            axios({
              method:'DELETE',
              url:'api/people/'+id,
            })
            .then((response)=> {
                this.update();
            });
        },
        update: function(){
            this.$root.$emit('update');
        }
    }
}
</script>
