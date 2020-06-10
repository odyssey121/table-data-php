
export const actions = {

    setPerPage(vuexContext, payload) {
        vuexContext.commit('SET_PER_PAGE', payload)
    },
    fetchDistance(vuexContext, searchStr) {
        vuexContext.commit("SET_LOADING", true);
        let apiUrl = '/api/distance/';
        if (searchStr) {
            apiUrl = `${apiUrl}/?search=${searchStr}`
        }
        this.$axios.get(apiUrl).then(({ data }) => {
            vuexContext.commit("SET_DISTANCES", data)
            vuexContext.commit("SET_LOADING", false);
        })
            .catch(e => {
                vuexContext.error(e);
                vuexContext.commit("SET_LOADING", false)
            });

    },
    setFilters(vuexContext, payload) {
        vuexContext.commit("SET_LOADING", true);
        const { column, min, max } = payload
        let apiUrl = `/api/distance/?filter=${column}${min ? '&min=' + min : ''}${max ? '&max=' + max : ''}`;
        this.$axios.get(apiUrl).then(({ data }) => {
            vuexContext.commit("SET_DISTANCES", data)
            vuexContext.commit("SET_LOADING", false);
        })
            .catch(e => {
                vuexContext.error(e);
                vuexContext.commit("SET_LOADING", false)
            });

    },
    setCurrentPage(vuexContext, page) {
        vuexContext.commit('SET_CURRENT_PAGE', page)


    },

}

export const mutations = {

    SET_LOADING(state, payload) {
        state.fetching = payload

    },


    SET_CURRENT_PAGE(state, page) {
        state.currentPage = page
    },

    SET_DISTANCES(state, arr) {
        state.distances = arr
    },
    SET_PER_PAGE(state, payload) {
        state.perPage = payload
    },


}

export const getters = {

    getDistances: (state, _getters) => page => {
        let result = state.distances.slice((page - 1) * state.perPage, (page - 1) * state.perPage + state.perPage)
        return result
    }
    ,
    getPerPage: (state, _getters) =>
        state.perPage,
    getTotalPage: (state, _getters) =>
        Math.ceil(state.distances.length / state.perPage),
    getCurrentPage: (state, _getters) =>
        state.currentPage,

    getLoading: (state, _getters) =>
        state.fetching


}

export const state = () => ({ distances: [], perPage: 10, currentPage: 1, fetching: false })