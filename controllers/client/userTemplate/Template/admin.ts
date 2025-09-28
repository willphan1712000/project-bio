import { createContext, useContext } from "react";

export type Data = {
    // some data type does here
}

export type ContextDataType = [
    Data,
    React.Dispatch<React.SetStateAction<Data>>
] | undefined

export const MyContext = createContext<ContextDataType>(undefined)

export default function useMyContext() {
    const data = useContext(MyContext)

    if ( data === undefined )
        throw new Error("Context is undefined")
        
    return data
}