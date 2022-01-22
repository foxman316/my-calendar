import axios from 'axios';

const state = {
    events: [],
    event: null,
};

const getters = {
    events: state => state.events.map(event => {
        return {
            ...event,
            start: new Date(event.start),
            end: new Date(event.end)
        };
    }),
    event: state => state.event ? {
        ...state.event,
        start: new Date(state.event.start),
        end: new Date(state.event.end),
    } : null,
};

const mutations = {
    setEvents: (state, events) => (state.events = events),
    setEvent: (state, event) => (state.event = event), // 追加
}

const actions = {
    async fetchEvents({ commit }) {
        const response = await axios.get('/api/events');
        commit('setEvents', response.data);
    },
    setEvent({ commit }, event) {
        commit('setEvent', event);
    },
};

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
};