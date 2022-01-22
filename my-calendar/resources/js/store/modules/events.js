import axios from 'axios';

const state = {
    events: []
};

const getters = {
    events: state => state.events.map(event => {
        return {
            ...event,
            start: new Date(event.start),
            end: new Date(event.end)
        };
    }),
}

const mutations = {
    setEvents: (state, events) => (state.events = events)
}

const actions = {
    async fetchEvents({ commit }) {
        const response = await axios.get('/api/events');
        commit('setEvents', response.data);
    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
};
