<template>
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">
          <div class="modal-header">
            <h3>Редактировать отдел</h3>
          </div>
          <div class="modal-body">
              <form id='editDept' v-on:submit.prevent='edit()'>
                <div class="form-group">
                  <label for="addDeptName">Название</label>
                  <input type="text" class="form-control" id='addDeptName' placeholder="Название" v-model='name' ref='name'>
                </div>
              </form>
          </div>
          <div class="modal-footer">
              <p style="color:red;">{{error}}</p>
              <button type='submit' form='editDept' class="btn btn-default" >Редактировать</button>
              <button class="btn btn-default" @click='close()'>Отмена</button>
            </slot>
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
              id:'',
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
        this.$emit('update:show', false);
        this.error='';
      },
      updateData(id){
        var dept = this.departments.find(function(el){return el.id === id;});  
        this.name = dept.name;
        this.id = dept.id;
      },
      edit(){
        axios({
          method:'PUT',
          url:'api/departments/'+this.id,
          data:{
            name:this.name,
          }
        })
        .then((response)=> {
          this.update();
          this.close();
          this.name='';
        })
        .catch((error)=>{
          this.showError(error.response.data.message);
        });
      },
      showError:function(error){
        this.error = '*'+error;
      },
      update: function(){
        this.$root.$emit('update');
      },
    },
    mounted() {
      this.$root.$on('editDepartment', this.updateData);
      document.addEventListener("keydown", (e) => {
        if (this.show && (e.keyCode == 27 )) {
        this.close();
        }
      });
    },
}
</script>
