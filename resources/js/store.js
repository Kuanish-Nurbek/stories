import { createStore } from 'vuex'

const store = createStore({ 
    state () {
      return {
        count: 0,
        isVisibleBlockTest: false
      }
    },
    mutations: {
      increment (state) {
        state.count++
      },
      CHANGE_TEST (state)  {
        state.isVisibleBlockTest = !state.isVisibleBlockTest
      }
    },
    actions: {
        TOGGLE_TEST({commit}){
            commit('CHANGE_TEST')
        }
    },
    getters: {
        TEST_STATE(state) {
            return state.isVisibleBlockTest;
        }
    }
})

export default store;
