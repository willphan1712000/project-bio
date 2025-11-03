/**
 * This is UserSocial type fetched from bio server
 */
export type UserSocial = | "Facebook" | "Instagram" | "Messenger" | "X" | "Tiktok" | "Youtube" | "Threads" | "Linkedin" | "Pinterest" | "Zalo" | "Booking" | "OrderOnline" | "HotSale" | "Website" | "Menu" | "Zillow" | "Realtor"

export type UserPhone = | "Mobile" | "Work" | "Hotline" | "Whatsapp" | "Viber"

export type UserInfo = | "Name" | "Image" | "Organization" | "Description" | "Email" | "Address" | "Position" | "name" | "image" | "organization" | "description" | "position"

export type User = | "username" | "password" | "email" | "token" | "deleteToken" | "createdAt"

export type User_Text = | "name" | "organizatio" | "position" | "description"

type EachInfo = {
    value: string,
    label: string,
    html: string,
    htmlWValue: string,
    htmlAdmin: string,
    htmlAdminWValue: string
}

type User_Info_Required = {
    [K in UserPhone]: EachInfo
} & {
    [K in UserSocial]: EachInfo
} & {
    [K in UserInfo]: EachInfo
}

export type User_Info = Partial<User_Info_Required>

type Raw_User_Info = {
    [K in UserPhone]: string
} & {
    [K in UserSocial]: string
} & {
    [K in UserInfo]: string
}

export type Raw_Info = Partial<Raw_User_Info>

export type User_Style = {
    [K in User_Text]: {
        font: string,
        fontSize: number,
        fontColor: string
    }
}

export type User_Resources = {
    qrcode: string,
    vcard: string,
    share: string
}