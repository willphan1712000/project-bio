import { createContext, useContext } from "react";

export type Data = {
    isAdmin: boolean,
    frontTemplateHTML: HTMLDivElement | undefined,
    setFrontTemplateHTML: React.Dispatch<React.SetStateAction<HTMLDivElement | undefined>>
}

export type ContextDataType = Data | undefined

/**
 * - This holds context for template properties
 * - Such as a property to determine if a template is for user or admin
 */
export const MyContext = createContext<ContextDataType>(undefined)

export default function useMyContext() {
    const data = useContext(MyContext)

    if ( data === undefined )
        throw new Error("Template context is undefined")
        
    return data
}