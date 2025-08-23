/**
 * This is UserSocial type fetched from bio server
 */
export type UserSocial = | "Facebook" | "Instagram" | "Messenger" | "X" | "Tiktok" | "Youtube" | "Threads" | "Linkedin" | "Pinterest" | "Zalo" | "Booking" | "OrderOnline" | "HotSale" | "Website" | "Menu" | "Zillow" | "Realtor"

export type UserPhone = | "Mobile" | "Work" | "Hotline" | "Whatsapp" | "Viber"

export type UserInfo = | "Name" | "Image" | "Organization" | "Description" | "Email" | "Address" | "Position"

export type User = | "username" | "password" | "email" | "token" | "deleteToken" | "createdAt"

type User_Info_Required = {
    [K in UserPhone]: string
} & {
    [K in UserSocial]: string
} & {
    [K in UserInfo]: string
}

export type User_Info = Partial<User_Info_Required>