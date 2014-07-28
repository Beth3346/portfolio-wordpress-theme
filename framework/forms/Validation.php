<?php

class Validation {

	public $errors = array();

	public function validate( $data, $rules ) {

		$valid = TRUE;

		// extracts callback from $rule

		function parseCallback( $callback ) {

			$colon = strpos( $callback, ':' );
			$length = strlen( $callback );

			if ( $colon == FALSE ) {
				$rule = $callback;
			} else {
				$rule = substr( $callback , 0, $length - ($length - $colon));
			}

			return $rule;
		}

		// extracts $params array from $rule

		function parseParam( $callback ) {
			$param_list = NULL;
			$colon = strpos( $callback, ':' );
			$params = array(); 

			if ( $colon == FALSE ) {
				$param = NULL;
			} else {
				$param_list = substr( $callback , $colon + 1 );
			}

			if ( $param_list != NULL ) {
				$params = explode(':', $param_list);
			}

			return $params;			
		}

		foreach ( $rules as $fieldname => $rule ) {
			// Extract rules as callbacks
			
			$callbacks = explode( '|', $rule );

			// Call the validation callback
			
			foreach ( $callbacks as $callback ) {
				$value = isset( $data[$fieldname] ) ? $data[$fieldname] : NULL;

				$params = parseParam( $callback );

				$callback = parseCallback( $callback );

				if ( $this->$callback( $value, $fieldname, $params ) == FALSE ) {
					$valid = FALSE;
				}
			}
		}

		return $valid;
	}

	// checks that a value is numeric

	public function numeric( $value, $fieldname ) {

		$pattern = '/^[0-9.,]*$/';		

		if ( preg_match( $pattern, $value ) ) {
			$valid = TRUE;
		} else {
			$valid = FALSE;	
			$this->errors[] = "Please provide a valid number $fieldname";
		}

		return $valid;
	}

	// checks that a value is currency

	public function currency( $value, $fieldname ) {

		$pattern = '/^[0-9.,$]*$/';		

		if ( preg_match( $pattern, $value ) ) {
			$valid = TRUE;
		} else {
			$valid = FALSE;	
			$this->errors[] = "Please provide a valid number $fieldname";
		}

		return $valid;
	}

	// checks that a value is an integer

	public function integer( $value, $fieldname ) {

		$valid = filter_var($value, FILTER_VALIDATE_INT);

		if ( $valid == FALSE ) {
			$this->errors[] = "Please provide a whole number for $fieldname";
		} else {
			$valid = TRUE;
		}

		return $valid;
	}

	// checks for an integer that is less than a max value

	public function max( $value, $fieldname, $params ) {

		$options = array (
			'options' => array(
				'max_range' => $params[0]
			)
		);

		$valid = filter_var($value, FILTER_VALIDATE_INT, $options);

		if ( $valid == FALSE ) {
			$this->errors[] = "Please provide a whole number less than $params[0] for $fieldname";
		} else {
			$valid = TRUE;
		}

		return $valid;
	}

	// checks for an integer that is greater than a min value

	public function min( $value, $fieldname, $params ) {

		$options = array (
			'options' => array(
				'min_range' => $params[0]
			)
		);

		$valid = filter_var($value, FILTER_VALIDATE_INT, $options);

		if ( $valid == FALSE ) {
			$this->errors[] = "Please provide a whole number greater than $params[0] for $fieldname";
		} else {
			$valid = TRUE;
		}

		return $valid;
	}

	// checks for an integer that falls within a specified range

	public function range( $value, $fieldname, $params ) {

		$options = array (
			'options' => array(
				'min_range' => $params[0],
				'max_range' => $params[1]
			)
		);

		$valid = filter_var($value, FILTER_VALIDATE_INT, $options);

		if ( $valid == FALSE ) {
			$this->errors[] = "Please provide a whole number between $params[0] and $params[1] for $fieldname";
		} else {
			$valid = TRUE;
		}

		return $valid;
	}

	// most form values are at least 3 characters long
	// automatically rejects any value that is less than 3 characters in length

	public function short( $value, $fieldname ) {

		$value = trim( $value );

		if ( strlen( $value ) > 3 ) {
			$valid = TRUE;
		} else {
			$valid = FALSE;	
			$this->errors[] = "$fieldname should be more than two characters";			
		}

		return $valid;
	}

	// checks that a value is alpha characters only

	public function alpha( $value, $fieldname ) {

		$pattern = '/^[a-z]*$/i';		

		if ( preg_match( $pattern, $value ) ) {
			$valid = TRUE;
		} else {
			$valid = FALSE;	
			$this->errors[] = "Please provide a valid $fieldname";
		}

		return $valid;
	}

	// checks a value for a minimum string length

	public function minLength( $value, $fieldname, $params ) {
		$value = trim( $value );

		if ( strlen( $value ) > $params[0] ) {
			$valid = TRUE;
		} else {
			$valid = FALSE;	
			$this->errors[] = "$fieldname should be more than $params[0] characters";			
		}

		return $valid;
	}

	// checks a value for a maximum string length

	public function maxLength( $value, $fieldname, $params ) {
		$value = trim( $value );

		if ( strlen( $value ) < $params[0] ) {
			$valid = TRUE;
		} else {
			$valid = FALSE;	
			$this->errors[] = "$fieldname should be less than $params[0] characters";			
		}	

		return $valid;	
	}

	// checks a value for an exact string length

	public function length( $value, $fieldname, $params ) {
		$value = trim( $value );

		if ( strlen( $value ) == $params[0] ) {
			$valid = TRUE;
		} else {
			$valid = FALSE;	
			$this->errors[] = "$fieldname should be exactly $params[0] characters";			
		}	

		return $valid;		
	}

	// checks a value for a string length range

	public function betweenLength( $value, $fieldname, $params ) {
		$value = trim( $value );
		$str_len = strlen( $value ); 
		$min = $params[0];
		$max = $params[1];

		if ( $str_len >= $min and $str_len <= $max ) {
			$valid = TRUE;
		} else {
			$valid = FALSE;	
			$this->errors[] = "$fieldname should be between $min and $max characters";			
		}	

		return $valid;	
	}

	// accepts alpha characters, ' ', and '.'
	// Does not ensure that value is actually a first name and last name
	// Only looks for acceptable chararacters that would appear in a person's full name
	// Examples: John Q. Public, John, John Doe
	
	public function fullName( $value, $fieldname ) {

		$pattern = '/^[a-z.,\s]*$/i';		

		if ( preg_match( $pattern, $value ) ) {
			$valid = TRUE;
		} else {
			$valid = FALSE;	
			$this->errors[] = "Please provide a valid $fieldname";
		}

		return $valid;
	}

	// validates that a ten digit phone number with an optional extension is provided
	// only validates US phone numbers for now

	public function phone( $value, $fieldname ) {

		function cleanPhone( $value ) {

			// remove whitespace
			$value = trim( $value );

			// look for extension followed by 'x'
			// split phone number and extension into two seperate strings				
			if ( strpos($value, 'x') != FALSE ) {
				$complete_phone = preg_split( '/[x]/i', $value );

				$value = $complete_phone[0];
			}

			// strip spaces and everything that is not a number
			$value = preg_replace('/[^0-9]*/', '', $value);

			// strip leading 1
			$value = preg_replace('/\b[1]/', '', $value);

			return $value;
		}

		// no bad area codes or toll free / pay per call
		// BAD_AREA_CODES = open('bad-area-codes.txt', 'r').read().split('\n');

		// make sure phone number is exactly 10 digits
		
		if ( strlen( $value ) < 10 ) {
			$valid = FALSE;
			$this->errors[] = "Too short! Please provide a valid phone number for $fieldname";			
		} else {		
			$phone = cleanPhone( $value );
			
			if ( strlen( $phone ) != 10 ) {
				$valid = FALSE;
				$this->errors[] = "Please provide a valid phone number for $fieldname";
			} else {
				$valid = TRUE;
			}			
		}

		return $valid;	
	}

	// checks for a valid email

	public function email( $value, $fieldname ) {
		$valid = filter_var($value, FILTER_VALIDATE_EMAIL);

		if ( $valid == FALSE ) {
			$this->errors[] = "Please provide a valid email address for $fieldname";
		} else {
			$valid = TRUE;
		}

		return $valid;
	}

	// checks for a valid url

	public function url( $value, $fieldname ) {
		$valid = filter_var($value, FILTER_VALIDATE_URL);

		if ( $valid == FALSE ) {
			$this->errors[] = "Please provide a valid url for $fieldname";
		} else {
			$valid = TRUE;
		}

		return $valid;
	}

	// checks a string to see if it contains any urls

	public function nourl( $value, $fieldname ) {
		$pattern = '/(https?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?/i'; // url

		if ( preg_match( $pattern, $value ) ) {
			$valid = FALSE;
			$this->errors[] = "Invalid $fieldname";
		} else {
			$valid = TRUE;
		}

		return $valid;
	}

	// checks a string to see if it contains any html tags

	public function notags( $value, $fieldname ) {
		$pattern = '/[<>]/'; // tags

		if ( preg_match( $pattern, $value ) ) {
			$valid = FALSE;
			$this->errors[] = "$fieldname cannot contain html";
		} else {
			$valid = TRUE;
		}

		return $valid;
	}

	// checks to see that any required fields are not null

	public function required( $value, $fieldname ) {
		$valid = !empty( $value );

		if ( $valid == FALSE ) {
			$this->errors[] = "The $fieldname is required";
		} else {
			$valid = TRUE;
		}

		return $valid;
	}

	// checks for header attack attempts

	public function attacks( $value, $fieldname ) {
		$pattern = '/Content-Type:|Bcc:|Cc:/i';

		if ( preg_match( $pattern, $value ) ) {
			$valid = FALSE;
			$this->errors[] = "Invalid $fieldname";
		} else {
			$valid = TRUE;
		}

		return $valid;
	}

	// honeypot
	
	public function honeypot( $value, $fieldname ) {

		if ( ( !$value ) ) {
			$valid = TRUE;
		} else {
			$valid = FALSE;
			$this->errors[] = "There was an error processing your message";
		}

		return $valid;
	}
}