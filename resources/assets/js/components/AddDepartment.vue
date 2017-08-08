<template>
  <transition  name="modal" >
    <div class="modal-mask">
      <div class="modal-wrapper">
        <div class="modal-container">
          <div class="modal-header">
            <h3>Добавить отдел</h3>
          </div>
          <div class="modal-body">
              <form>
                <div class="form-group">
                  <label for="addDeptName" >Название</label>
                  <input type="text" class="form-control" id='addDeptName' placeholder="Название" v-model='name'>
                </div>
              </form>
          </div>
          <div class="modal-footer">
              <button class="btn btn-default" @click='add()'>Добавить</button>
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
              }
          },
        props:['show'],
        methods:{
          close: function(){
            this.$emit('update:show', false)
          },
          add:function(){
            axios({
                  method:'POST',
                  url:'api/departments',
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
            }
        },
        mounted() {
            console.log('Popup mounted.')
        },
    }
</script>
