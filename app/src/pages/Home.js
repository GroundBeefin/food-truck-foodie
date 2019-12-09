import React from "react";
import Jumbotron from "react-bootstrap/Jumbotron";
import MainFTFlogo4 from "../images/MainFTFLogo4.png";
import Image from "react-bootstrap/Image";


export const Home = () => {
	return (
		<>
			<container-fluid>
				<Jumbotron>
					<div className="d-flex justify-content-center">
						<Image src={MainFTFlogo4} alt="logo"/>
					</div>
				</Jumbotron>
			</container-fluid>
		</>
	)
};
