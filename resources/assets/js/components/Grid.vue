<template>
    <div id='grid' class='widget table-responsive' >
        <h2 class="widget-header">#Сетка</h2>
        <table class="table">
            <thead>
                <th></th>
                <th v-for='department in departments'>{{department.name}}</th>
            </thead>
            <tbody>
                <tr v-for='person in people'>
                    <th>{{person.name}}</th>
                    <td v-for='element in person.deptRelations'>{{element}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
    export default {
        props:['departments','people'],
        mounted() {
            console.log('Grid mounted.')
        }
    }
</script>
