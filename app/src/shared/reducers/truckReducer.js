export default (state = [], action) => {
	switch(action.type) {
		case "GET_ALL_TRUCKS":
			return action.payload;
		default:
			return state;
	}
}