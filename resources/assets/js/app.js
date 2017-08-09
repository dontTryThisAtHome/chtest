
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
window._ = require('lodash');


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

var Grid = Vue.component('grid', require('./components/Grid.vue')),
	Departments = Vue.component('departments', require('./components/Departments.vue')),
    People = Vue.component('people', require('./components/People.vue')),
    AddDepartment = Vue.component('adddepartment', require('./components/AddDepartment.vue')),
    EditDepartment = Vue.component('editdepartment', require('./components/EditDepartment.vue')),
    AddPerson = Vue.component('addperson', require('./components/AddPerson.vue')),
    EditPerson = Vue.component('editperson', require('./components/EditPerson.vue')),
    ErrorModal = Vue.component('errormodal', require('./components/ErrorModal.vue'));

const app = new Vue({
    el: '#app',
    components:{
    	'grid':Grid,
    	'departments':Departments,
    	'people':People,
        'adddepartment': AddDepartment,
        'editdepartment':EditDepartment,
        'addperson': AddPerson,
        'editperson':EditPerson,
        'errormodal':ErrorModal,
    },
    data:{
        departments: [],
        people:[],
        showAddDepartment: false,
        showEditDepartment: false,
        showAddPerson: false,
        showEditPerson: false,
        showErrorModal:false,
    },
    methods:{
        update: function(){
            axios.get('api/departments').then((response) =>{
            this.departments = response.data;
            });
            axios.get('api/people').then((response) =>{
                this.people = response.data;
            });
        },
    },
    created(){
        this.update();
    },
    mounted(){
        this.$root.$on('update',this.update)
    }
});


