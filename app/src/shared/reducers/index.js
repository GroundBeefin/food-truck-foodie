import {combineReducers} from "redux"
import userReducer from "./user-reducer";
import userPostsReducer from "./user-posts-reducer"
import truckReducer from "./truckReducer";

export const combinedReducers = combineReducers({
	users: userReducer,
	userPosts: userPostsReducer,
	trucks: truckReducer,
});