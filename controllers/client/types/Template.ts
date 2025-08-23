import { UserInfo, UserPhone, UserSocial } from "./User"

/**
 * This is Template type fetched from template server
 */
export type Template = {
    id: number,
    thumbnail: string,
    thumbnail_url: string,
    template: string,
    template_url: string,
    type: string,
    createdAt: string,
    unit_price: number,
    recurring_price: number,
    isActive: boolean
}

/**
 * This is Template Info Type fetched from template server
 */
export type Template_Info = {
    [K in UserPhone | UserSocial | UserInfo ]: {
        id: number,
        x: number,
        y: number,
        h: number,
        w: number
    }
}