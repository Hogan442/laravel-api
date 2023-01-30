# Driver API Readme

## Endpoints

The following endpoints are available for use:

### Driver Endpoints

#### CREATE /driver/
- Creates a new driver record.
- Request Body: 
  - id_number: integer
  - phone_number: integer

#### GET /drivers/
- Retrieves a list of all drivers.

#### GET /driver/{id}
- Retrieves a specific driver record by id.

#### GET /driver/{id}/vehicle/
- Retrieves the vehicle assigned to a specific driver.

#### UPDATE /drivers/{id}
- Updates a specific driver record by id.
- Request Body: 
  - id_number: integer
  - phone_number: integer

#### UPDATE /drivers/{id}/details/
- Updates the details of a specific driver record by id.
- Request Body: 
  - home_address: string
  - fist_name: string
  - last_name: string
  - license_type: enum("A", "B", "C", "D") -> One of the four

#### DELETE /drivers/{id}
- Deletes a specific driver record by id.

#### DELETE /drivers/{id}/details/
- Deletes the details of a specific driver record by id.

### Vehicle Endpoints

#### CREATE /vehicle/
- Creates a new vehicle record.
- Request Body: 
  - id: integer
  - lisence_plate: string
  - vehicle_make: string
  - vehicle_model: string
  - model_year: date(Y)
  - insured: boolean/ 0, 1
  - last_service: date(Y-m-d)

#### GET /vehicles/
- Retrieves a list of all vehicles.

#### UPDATE /vehicle/{id}
- Updates a specific vehicle record by id.
- Request Body: 
  - id: integer
  - lisence_plate: string
  - vehicle_make: string
  - vehicle_model: string
  - model_year: date(Y)
  - insured: boolean/ 0, 1

#### DELETE /vehicle/{id}
- Deletes a specific vehicle record by id.
