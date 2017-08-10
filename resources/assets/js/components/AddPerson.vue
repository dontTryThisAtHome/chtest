<template>
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">
          <div class="modal-header">
            <h3>Добавить сотрудника</h3>
          </div>
          <div class="modal-body">
            <form id='addPerson' v-on:submit.prevent='add()'>
              <div class="form-group">
                <label for="addPersName">Имя</label>
                <input type="text" class="form-control" id='addPersName' placeholder="Имя" v-model='name' ref='name'>
              </div>
              <div class="form-group">
                <label for="addPersSurmame">Фимилия</label>
                <input type="text" class="form-control" id='addPersSurmame' placeholder="Фамилия" v-model='surname'>
              </div>
              <div class="form-group">
                <label for="addPersGender">Пол</label>
                <select class="form-control" id='addPersGender' v-model='gender'>
                  <option>мужской</option>
                  <option>женский</option>
                </select>
              </div>
              <div class="form-group">
                <label for="addPersWage">Заработная плата</label>
                <input type="number" class="form-control" id='addPersWage' v-model='wage'>
              </div>
               <div class="form-group">
                <label for="addPersDepts">Отделы</label>
                <select multiple class="form-control" id='addPersDepts' v-model='departmentsm'>
                  <option v-for='department in departments'  v-bind:value="department.id">{{department.name}}</option>
                </select>
              </div>
            </form>
          </div>
          <div class="modal-footer">
              <p style="color:red;">{{error}}</p>
              <button tupe='submit' form='addPerson' class="btn btn-default">Добавить</button>
              <button class="btn btn-default" @click='close()'>Отмена</button>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>
<script>
export default {
  data: function () {
          return {
            name: '',
            surname:'',
            wage:'',
            gender:'',
            departmentsm:[],
            error:'',
          }
        },
  watch:{
    show:function(){
      this.$refs.name.focus();
    }
  },
  props:['show','departments'],
    methods:{
      close: function(){
        this.$emit('update:show', false)
        this.name='';
        this.surname='';
        this.gender='';
        this.wage='';
        this.departmentsm=[];
        this.error = '';
      },
      add:function(){
        axios({
          method:'POST',
          url:'api/people',
          data:{
            name:this.name,
            surname:this.surname,
            gender:this.gender,
            wage:this.wage,
            departments:this.departmentsm,
          }
        })
        .then((response)=> {
          this.update();
          this.close();
        })
        .catch((error)=>{
          this.showError(error.response.data.message);
        });
      },
      showError:function(error){
        this.error ='*'+error;
      },
      update: function(){
        this.$root.$emit('update');
      }
    },
    mounted() {
      document.addEventListener("keydown", (e) => {
        if (this.show && (e.keyCode == 27 )) {
        this.close();
        }
      });
    },
}
</script>
