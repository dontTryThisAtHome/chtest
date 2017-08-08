<template>
  <transition name="modal">
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">
          <div class="modal-header">
            <h3>Редактировать отдел</h3>
          </div>
          <div class="modal-body">
              <form>
                <div class="form-group">
                  <label for="addDeptName">Название</label>
                  <input type="text" class="form-control" id='addDeptName' placeholder="Название" v-model='name'>
                </div>
              </form>
          </div>
          <div class="modal-footer">
              <button class="btn btn-default" @click='edit()'>Редактировать</button>
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
              }
        },
        props:['show','departments'],
        methods:{
          close: function(){
            this.$emit('update:show', false)
          },
          updateData(id){
            var dept = this.departments.find(function(el){
                  return el.id === id;
                });  
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
                });
          },
          update: function(){
                this.$root.$emit('update');
          },
        },
        watch:{
          name:function(){
              this.name = this.name;

          }
        },
        mounted() {
            console.log('Popup mounted.');
            this.$root.$on('editDepartment', this.updateData);
        },
        
    }
</script>
