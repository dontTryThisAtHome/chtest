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
                    <th>{{person.name+" "}}{{person.surname}}</th>
                    <td v-for='element in person.deptRelations' v-html="element"></td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props:['departments','people'],
    mounted() {
    }
}
</script>
