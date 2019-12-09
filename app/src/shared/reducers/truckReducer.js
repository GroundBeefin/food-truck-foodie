export default (state = [], action) => {
	switch(action.type) {
		case "GET_TRUCK_BY_TRUCK_ID":
			return action.payload;
		case "GET_ALL_TRUCKS":
			return action.payload;
		default:
			return state;
	}
}