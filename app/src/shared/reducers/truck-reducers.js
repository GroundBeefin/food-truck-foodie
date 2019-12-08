import {combineReducers} from "redux";
import truckReducer from "./truckReducer";

export const  combineReducers = combineReducers({
		trucks: truckReducer,
});